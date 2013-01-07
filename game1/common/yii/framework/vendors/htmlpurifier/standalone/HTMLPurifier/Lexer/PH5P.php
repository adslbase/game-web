<?php

/**
 * Experimental HTML5-based parser using Jeroen van der Meer's PH5P library.
 * Occupies space in the HTML5 pseudo-namespace, which may cause conflicts.
 * 
 * @note
 *    Recent changes to PHP's DOM extension have resulted in some fatal
 *    error conditions with the original version of PH5P. Pending changes,
 *    this lexer will punt to DirectLex if DOM throughs an exception.
 */

class HTMLPurifier_Lexer_PH5P extends HTMLPurifier_Lexer_DOMLex {
    
    public function tokenizeHTML($html, $config, $context) {
        $new_html = $this->normalize($html, $config, $context);
        $new_html = $this->wrapHTML($new_html, $config, $context);
        try {
            $parser = new HTML5($new_html);
            $doc = $parser->save();
        } catch (DOMException $e) {
            // Uh oh, it failed. Punt to DirectLex.
            $lexer = new HTMLPurifier_Lexer_DirectLex();
            $context->register('PH5PError', $e); // save the error, so we can detect it
            return $lexer->tokenizeHTML($html, $config, $context); // use original HTML
        }
        $tokens = array();
        $this->tokenizeDOM(
            $doc->getElementsByTagName('html')->item(0)-> // <html>
                  getElementsByTagName('body')->item(0)-> //   <body>
                  getElementsByTagName('div')->item(0)    //     <div>
            , $tokens);
        return $tokens;
    }
    
}

/*

Copyright 2007 Jeroen van der Meer <http://jero.net/> 

Permission is hereby granted, free of charge, to any person obtaining a 
copy of this software and associated documentation files (the 
"Software"), to deal in the Software without restriction, including 
without limitation the rights to use, copy, modify, merge, publish, 
distribute, sublicense, and/or sell copies of the Software, and to 
permit persons to whom the Software is furnished to do so, subject to 
the following conditions: 

The above copyright notice and this permission notice shall be included 
in all copies or substantial portions of the Software. 

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS 
OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF 
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. 
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY 
CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, 
TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE 
SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE. 

*/

class HTML5 {
    private $data;
    private $char;
    private $EOF;
    private $state;
    private $tree;
    private $token;
    private $content_model;
    private $escape = false;
    private $entities = array('AElig;','AElig','AMP;','AMP','Aacute;','Aacute',
    'Acirc;','Acirc','Agrave;','Agrave','Alpha;','Aring;','Aring','Atilde;',
    'Atilde','Auml;','Auml','Beta;','COPY;','COPY','Ccedil;','Ccedil','Chi;',
    'Dagger;','Delta;','ETH;','ETH','Eacute;','Eacute','Ecirc;','Ecirc','Egrave;',
    'Egrave','Epsilon;','Eta;','Euml;','Euml','GT;','GT','Gamma;','Iacute;',
    'Iacute','Icirc;','Icirc','Igrave;','Igrave','Iota;','Iuml;','Iuml','Kappa;',
    'LT;','LT','Lambda;','Mu;','Ntilde;','Ntilde','Nu;','OElig;','Oacute;',
    'Oacute','Ocirc;','Ocirc','Ograve;','Ograve','Omega;','Omicron;','Oslash;',
    'Oslash','Otilde;','Otilde','Ouml;','Ouml','Phi;','Pi;','Prime;','Psi;',
    'QUOT;','QUOT','REG;','REG','Rho;','Scaron;','Sigma;','THORN;','THORN',
    'TRADE;','Tau;','Theta;','Uacute;','Uacute','Ucirc;','Ucirc','Ugrave;',
    'Ugrave','Upsilon;','Uuml;','Uuml','Xi;','Yacute;','Yacute','Yuml;','Zeta;',
    'aacute;','aacute','acirc;','acirc','acute;','acute','aelig;','aelig',
    'agrave;','agrave','alefsym;','alpha;','amp;','amp','and;','ang;','apos;',
    'aring;','aring','asymp;','atilde;','atilde','auml;','auml','bdquo;','beta;',
    'brvbar;','brvbar','bull;','cap;','ccedil;','ccedil','cedil;','cedil',
    'cent;','cent','chi;','circ;','clubs;','cong;','copy;','copy','crarr;',
    'cup;','curren;','curren','dArr;','dagger;','darr;','deg;','deg','delta;',
    'diams;','divide;','divide','eacute;','eacute','ecirc;','ecirc','egrave;',
    'egrave','empty;','emsp;','ensp;','epsilon;','equiv;','eta;','eth;','eth',
    'euml;','euml','euro;','exist;','fnof;','forall;','frac12;','frac12',
    'frac14;','frac14','frac34;','frac34','frasl;','gamma;','ge;','gt;','gt',
    'hArr;','harr;','hearts;','hellip;','iacute;','iacute','icirc;','icirc',
    'iexcl;','iexcl','igrave;','igrave','image;','infin;','int;','iota;',
    'iquest;','iquest','isin;','iuml;','iuml','kappa;','lArr;','lambda;','lang;',
    'laquo;','laquo','larr;','lceil;','ldquo;','le;','lfloor;','lowast;','loz;',
    'lrm;','lsaquo;','lsquo;','lt;','lt','macr;','macr','mdash;','micro;','micro',
    'middot;','middot','minus;','mu;','nabla;','nbsp;','nbsp','ndash;','ne;',
    'ni;','not;','not','notin;','nsub;','ntilde;','ntilde','nu;','oacute;',
    'oacute','ocirc;','ocirc','oelig;','ograve;','ograve','oline;','omega;',
    'omicron;','oplus;','or;','ordf;','ordf','ordm;','ordm','oslash;','oslash',
    'otilde;','otilde','otimes;','ouml;','ouml','para;','para','part;','permil;',
    'perp;','phi;','pi;','piv;','plusmn;','plusmn','pound;','pound','prime;',
    'prod;','prop;','psi;','quot;','quot','rArr;','radic;','rang;','raquo;',
    'raquo','rarr;','rceil;','rdquo;','real;','reg;','reg','rfloor;','rho;',
    'rlm;','rsaquo;','rsquo;','sbquo;','scaron;','sdot;','sect;','sect','shy;',
    'shy','sigma;','sigmaf;','sim;','spades;','sub;','sube;','sum;','sup1;',
    'sup1','sup2;','sup2','sup3;','sup3','sup;','supe;','szlig;','szlig','tau;',
    'there4;','theta;','thetasym;','thinsp;','thorn;','thorn','tilde;','times;',
    'times','trade;','uArr;','uacute;','uacute','uarr;','ucirc;','ucirc',
    'ugrave;','ugrave','uml;','uml','upsih;','upsilon;','uuml;','uuml','weierp;',
    'xi;','yacute;','yacute','yen;','yen','yuml;','yuml','zeta;','zwj;','zwnj;');

    const PCDATA    = 0;
    const RCDATA    = 1;
    const CDATA     = 2;
    const PLAINTEXT = 3;

    const DOCTYPE  = 0;
    const STARTTAG = 1;
    const ENDTAG   = 2;
    const COMMENT  = 3;
    const CHARACTR = 4;
    const EOF      = 5;

    public function __construct($data) {

        $this->data = $data;
        $this->char = -1;
        $this->EOF  = strlen($data);
        $this->tree = new HTML5TreeConstructer;
        $this->content_model = self::PCDATA;

        $this->state = 'data';

        while($this->state !== null) {
            $this->{$this->state.'State'}();
        }
    }

    public function save() {
        return $this->tree->save();
    }

    private function char() {
        return ($this->char < $this->EOF)
            ? $this->data[$this->char]
            : false;
    }

    private function character($s, $l = 0) {
        if($s + $l < $this->EOF) {
            if($l === 0) {
                return $this->data[$s];
            } else {
                return substr($this->data, $s, $l);
            }
        }
    }

    private function characters($char_class, $start) {
        return preg_replace('#^(['.$char_class.']+).*#s', '\\1', substr($this->data, $start));
    }

    private function dataState() {
        // Consume the next input character
        $this->char++;
        $char = $this->char();

        if($char === '&' && ($this->content_model === self::PCDATA || $this->content_model === self::RCDATA)) {
            /* U+0026 AMPERSAND (&)
            When the content model flag is set to one of the PCDATA or RCDATA
            states: switch to the entity data state. Otherwise: treat it as per
            the "anything else"    entry below. */
            $this->state = 'entityData';

        } elseif($char === '-') {
            /* If the content model flag is set to either the RCDATA state or
            the CDATA state, and the escape flag is false, and there are at
            least three characters before this one in the input stream, and the
            last four characters in the input stream, including this one, are
            U+003C LESS-THAN SIGN, U+0021 EXCLAMATION MARK, U+002D HYPHEN-MINUS,
            and U+002D HYPHEN-MINUS ("<!--"), then set the escape flag to true. */
            if(($this->content_model === self::RCDATA || $this->content_model ===
            self::CDATA) && $this->escape === false &&
            $this->char >= 3 && $this->character($this->char - 4, 4) === '<!--') {
                $this->escape = true;
            }

            /* In any case, emit the input character as a character token. Stay
            in the data state. */
            $this->emitToken(array(
                'type' => self::CHARACTR,
                'data' => $char
            ));

        /* U+003C LESS-THAN SIGN (<) */
        } elseif($char === '<' && ($this->content_model === self::PCDATA ||
        (($this->content_model === self::RCDATA ||
        $this->content_model === self::CDATA) && $this->escape === false))) {
            /* When the content model flag is set to the PCDATA state: switch
            to the tag open state.

            When the content model flag is set to either the RCDATA state or
            the CDATA state and the escape flag is false: switch to the tag
            open state.

            Otherwise: treat it as per the "anything else" entry below. */
            $this->state = 'tagOpen';

        /* U+003E GREATER-THAN SIGN (>) */
        } elseif($char === '>') {
            /* If the content model flag is set to either the RCDATA state or
            the CDATA state, and the escape flag is true, and the last three
            characters in the input stream including this one are U+002D
            HYPHEN-MINUS, U+002D HYPHEN-MINUS, U+003E GREATER-THAN SIGN ("-->"),
            set the escape flag to false. */
            if(($this->content_model === self::RCDATA ||
            $this->content_model === self::CDATA) && $this->escape === true &&
            $this->character($this->char, 3) === '-->') {
                $this->escape = false;
            }

            /* In any case, emit the input character as a character token.
            Stay in the data state. */
            $this->emitToken(array(
                'type' => self::CHARACTR,
                'data' => $char
            ));

        } elseif($this->char === $this->EOF) {
            /* EOF
            Emit an end-of-file token. */
            $this->EOF();

        } elseif($this->content_model === self::PLAINTEXT) {
            /* When the content model flag is set to the PLAINTEXT state
            THIS DIFFERS GREATLY FROM THE SPEC: Get the remaining characters of
            the text and emit it as a character token. */
            $this->emitToken(array(
                'type' => self::CHARACTR,
                'data' => substr($this->data, $this->char)
            ));

            $this->EOF();

        } else {
            /* Anything else
            THIS DIFFERS GREATLY FROM THE SPEC: Get as many character that
            otherwise would also be treated as a character token and emit it
            as a single character token. Stay in the data state. */
            $len  = strcspn($this->data, '<&', $this->char);
            $char = substr($this->data, $this->char, $len);
            $this->char += $len - 1;

            $this->emitToken(array(
                'type' => self::CHARACTR,
                'data' => $char
            ));

            $this->state = 'data';
        }
    }

    private function entityDataState() {
        // Attempt to consume an entity.
        $entity = $this->entity();

        // If nothing is returned, emit a U+0026 AMPERSAND character token.
        // Otherwise, emit the character token that was returned.
        $char = (!$entity) ? '&' : $entity;
        $this->emitToken(array(
            'type' => self::CHARACTR,
            'data' => $char
        ));

        // Finally, switch to the data state.
        $this->state = 'data';
    }

    private function tagOpenState() {
        switch($this->content_model) {
            case self::RCDATA:
            case self::CDATA:
                /* If the next input character is a U+002F SOLIDUS (/) character,
                consume it and switch to the close tag open state. If the next
                input character is not a U+002F SOLIDUS (/) character, emit a
                U+003C LESS-THAN SIGN character token and switch to the data
                state to process the next input character. */
                if($this->character($this->char + 1) === '/') {
                    $this->char++;
                    $this->state = 'closeTagOpen';

                } else {
                    $this->emitToken(array(
                        'type' => self::CHARACTR,
                        'data' => '<'
                    ));

                    $this->state = 'data';
                }
            break;

            case self::PCDATA:
                // If the content model flag is set to the PCDATA state
                // Consume the next input character:
                $this->char++;
                $char = $this->char();

                if($char === '!') {
                    /* U+0021 EXCLAMATION MARK (!)
                    Switch to the markup declaration open state. */
                    $this->state = 'markupDeclarationOpen';

                } elseif($char === '/') {
                    /* U+002F SOLIDUS (/)
                    Switch to the close tag open state. */
                    $this->state = 'closeTagOpen';

                } elseif(preg_match('/^[A-Za-z]$/', $char)) {
                    /* U+0041 LATIN LETTER A through to U+005A LATIN LETTER Z
                    Create a new start tag token, set its tag name to the lowercase
                    version of the input character (add 0x0020 to the character's code
                    point), then switch to the tag name state. (Don't emit the token
                    yet; further details will be filled in before it is emitted.) */
                    $this->token = array(
                        'name'  => strtolower($char),
                        'type'  => self::STARTTAG,
                        'attr'  => array()
                    );

                    $this->state = 'tagName';

                } elseif($char === '>') {
                    /* U+003E GREATER-THAN SIGN (>)
                    Parse error. Emit a U+003C LESS-THAN SIGN character token and a
                    U+003E GREATER-THAN SIGN character token. Switch to the data state. */
                    $this->emitToken(array(
                        'type' => self::CHARACTR,
                        'data' => '<>'
                    ));

                    $this->state = 'data';

                } elseif($char === '?') {
                    /* U+003F QUESTION MARK (?)
                    Parse error. Switch to the bogus comment state. */
                    $this->state = 'bogusComment';

                } else {
                    /* Anything else
                    Parse error. Emit a U+003C LESS-THAN SIGN character token and
                    reconsume the current input character in the data state. */
                    $this->emitToken(array(
                        'type' => self::CHARACTR,
                        'data' => '<'
                    ));

                    $this->char--;
                    $this->state = 'data';
                }
            break;
        }
    }

    private function closeTagOpenState() {
        $next_node = strtolower($this->characters('A-Za-z', $this->char + 1));
        $the_same = count($this->tree->stack) > 0 && $next_node === end($this->tree->stack)->nodeName;

        if(($this->content_model === self::RCDATA || $this->content_model === self::CDATA) &&
        (!$the_same || ($the_same && (!preg_match('/[\t\n\x0b\x0c >\/]/',
        $this->character($this->char + 1 + strlen($next_node))) || $this->EOF === $this->char)))) {
            /* If the content model flag is set to the RCDATA or CDATA states then
            examine the next few characters. If they do not match the tag name of
            the last start tag token emitted (case insensitively), or if they do but
            they are not immediately followed by one of the following characters:
                * U+0009 CHARACTER TABULATION
                * U+000A LINE FEED (LF)
                * U+000B LINE TABULATION
                * U+000C FORM FEED (FF)
                * U+0020 SPACE
                * U+003E GREATER-THAN SIGN (>)
                * U+002F SOLIDUS (/)
                * EOF
            ...then there is a parse error. Emit a U+003C LESS-THAN SIGN character
            token, a U+002F SOLIDUS character token, and switch to the data state
            to process the next input character. */
            $this->emitToken(array(
                'type' => self::CHARACTR,
                'data' => '</'
            ));

            $this->state = 'data';

        } else {
            /* Otherwise, if the content model flag is set to the PCDATA state,
            or if the next few characters do match that tag name, consume the
            next input character: */
            $this->char++;
            $char = $this->char();

            if(preg_match('/^[A-Za-z]$/', $char)) {
                /* U+0041 LATIN LETTER A through to U+005A LATIN LETTER Z
                Create a new end tag token, set its tag name to the lowercase version
                of the input character (add 0x0020 to the character's code point), then
                switch to the tag name state. (Don't emit the token yet; further details
                will be filled in before it is emitted.) */
                $this->token = array(
                    'name'  => strtolower($char),
                    'type'  => self::ENDTAG
                );

                $this->state = 'tagName';

            } elseif($char === '>') {
                /* U+003E GREATER-THAN SIGN (>)
                Parse error. Switch to the data state. */
                $this->state = 'data';

            } elseif($this->char === $this->EOF) {
                /* EOF
                Parse error. Emit a U+003C LESS-THAN SIGN character token and a U+002F
                SOLIDUS character token. Reconsume the EOF character in the data state. */
                $this->emitToken(array(
                    'type' => self::CHARACTR,
                    'data' => '</'
                ));

                $this->char--;
                $this->state = 'data';

            } else {
                /* Parse error. Switch to the bogus comment state. */
                $this->state = 'bogusComment';
            }
        }
    }

    private function tagNameState() {
        // Consume the next input character:
        $this->char++;
        $char = $this->character($this->char);

        if(preg_match('/^[\t\n\x0b\x0c ]$/', $char)) {
            /* U+0009 CHARACTER TABULATION
            U+000A LINE FEED (LF)
            U+000B LINE TABULATION
            U+000C FORM FEED (FF)
            U+0020 SPACE
            Switch to the before attribute name state. */
            $this->state = 'beforeAttributeName';

        } elseif($char === '>') {
            /* U+003E GREATER-THAN SIGN (>)
            Emit the current tag token. Switch to the data state. */
            $this->emitToken($this->token);
            $this->state = 'data';

        } elseif($this->char === $this->EOF) {
            /* EOF
            Parse error. Emit the current tag token. Reconsume the EOF
            character in the data state. */
            $this->emitToken($this->token);

            $this->char--;
            $this->state = 'data';

        } elseif($char === '/') {
            /* U+002