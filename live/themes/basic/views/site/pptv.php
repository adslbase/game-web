<object width="<?php echo $width?>" height="<?php echo $height?>" id="ewaocx" classid="clsid:ef0d1a14-1033-41a2-a589-240c01edc078" CODEBASE="http://dl.pplive.com/PluginSetup.cab">
	<param name="logourl" value="http://res.pplive.com/ikan/0917/player/ikan_logo.jpg">
	<param name="dbclicktofullscreen" value="true" />
	<param name="showcontextmenu" value="true" />
	<param name="showstateinfo" value="true" />
	<param name="showchannelname" value="true" />
	<param name="showplayerbuffer" value="true" />
	<param name="showdownloadbuffer" value="true" />
	<param name="showdownloadrate" value="true" />
	<param name="showplaycontroller" value="true" />
	<param name="showplayprogress" value="true" />
	<param name="showloadingad" value="false" />
	<param name="showadcountdown" value="false" />
	<param name="adcfgurl" value="true" />
	<param name="enableupdate" value="true" />
	<param name="enableupdatetip" value="true" />
	<param name="updateurl" value="" />
        <param name="type" value="1" />
</object>
<script type="text/javascript">
                        var playLink = '<?php echo $stream ?>';
                        (function(){
                                function checkReady(){
                                        try{
                                                if(document.getElementById('ewaocx').IsReady){
                                                        document.getElementById('ewaocx').Url = playLink;
                                                        return;
                                                }
                                        }catch(e){}
                                        setTimeout(checkReady, 1000);
                                }
                                checkReady();
                        })();
                </script>