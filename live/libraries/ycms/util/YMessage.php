<?php

/**
 * YMessage class file.
 *
 * @author li feixiang  <wastorode@gmail.com>
 * @link http://ycms.sinaapp.com/ 
 * @copyright Copyright &copy; 2011-2015 Ycms Software LLC
 * @license http://www.opensource.org/licenses/bsd-license.php
 */
defined('INYCMS') or die;

/**
 * 这个类实干什么用的
 * 
 * @version $Id: YMessage.php UTF-8 2011-5-2 19:04:57 li feixiang 
 * @package util
 * @since 1.0
 * 
 */
class YMessage extends CApplicationComponent {

    public static function setFlash($value, $type = 'success', $key = 'contact', $defaultValue=null) {
        Ycms::app()->getUser()->setFlash($key, array('text' => $value, 'type' => $type), $defaultValue);
    }

    public static function getFlash($config = Array(), $text='', $key = 'contact') {

        if (empty($text) && Ycms::app()->user->hasFlash($key))
            $value = Ycms::app()->getUser()->getFlash($key);
        else
            return;

        self::$value['type']($config, $value['text']);
    }

    public static function error($config = Array(), $text='') {

        isset($config['width']) ? $width = $config['width'] : $width = 'auto';
        isset($config['background']) ? $background = $config['background'] : $background = '#ffb2b2';
        isset($config['border']) ? $border = $config['border'] : $border = '#ff8080';
        isset($config['icon']) ? $icon = $config['icon'] : $icon = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAMAAADXqc3KAAAAA3NCSVQICAjb4U/gAAAA5FBMVEX///8AAAAAAAAAAAAAAAC3Hx8AAAC+ISGyGRmwGBiuEhKrBQUAAAA3CQkAAAC6BQUzAAC4AAC6AABqDg5mCQlmAAD////+9/f77e386en65OT339/71tb/zMz1zc31xcX/v7/yv7/2vLzytLT/ra3uqqrypqb/oqL/mZnrnZ3ql5f3k5P9jY36iorqjo7tior/hIT4g4P3fHz0c3PwcXHjc3PqbW3wamruY2PmZWXfYGDtXFzpWVnoUlLmS0vlQUHdQ0PgOjrXOTndMTHcKyvaIiLYISHWFhbRFhbWExPRDAzMAAA8KX9KAAAATHRSTlMAESIzRFVVZmZmZmZ3iIiZmaq7u7u7////////////////////////////////////////////////////////////////////////t2sslwAAAAlwSFlzAAALEgAACxIB0t1+/AAAAB90RVh0U29mdHdhcmUATWFjcm9tZWRpYSBGaXJld29ya3MgOLVo0ngAAAFcSURBVCiRTZGJVoMwEEVTqFu17k6Ltlbr0kUQgRRSCaQIRWn+/3+cpHS557DkvjNZJoRojpZbDsgeJ3ng1wTL451vFY5t27zi+Lb9orX1meMxmYewSKTwPG+TXAjP95PujII7hwXO5uWnyl+nfhAEMUxCmIbg4n/gp1eEGJxSmrLIsjKYuRBGCKWJQcwoYqKs+ABmMJ1AyHCMj0nMOI4TeJAlPMKwA39VxhkqDDhP8k/oyQ4o5Gol84RzDJJ0Wf6+wL32g0r+fMtSJBiIIs+L5UB7eJYTAF4UAoNMs1gHnTeAuRqrilQhulDzroSqwJVw/XRY+36qhF4D981Y7K69xWIcRVhhtAU2gdJIb7dH8dhBINoGaTRvsKN4D3ouqnroictmg5DG4S2zbefLUsGHgzcTaY9tPLyLxshTv/+qvhuvEzYa14x2Xifr0yj2vErON5zte9yBYdYYtf8HfEJN4DsPG/oAAAAASUVORK5CYII%3D';

        if ((is_bool($icon) === true) && ($icon == false))
            echo "<div style='width: $width; margin-bottom: 10px; background: $background; padding: 6px; height:auto; border: 2px solid $border; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;'>$text</div>";
        else
            echo "<div style='width: $width; margin-bottom: 10px; background: $background; padding: 6px; height:auto; border: 2px solid $border; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;'><img src='$icon' alt='Icon' style='padding-right: 6px; vertical-align: middle; width: 24px; height: 24px' />$text</div>";
    }

    public static function warning($config = Array(), $text='') {

        isset($config['width']) ? $width = $config['width'] : $width = 'auto';
        isset($config['background']) ? $background = $config['background'] : $background = '#ffe5b2';
        isset($config['border']) ? $border = $config['border'] : $border = '#ffd580';
        isset($config['icon']) ? $icon = $config['icon'] : $icon = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAMAAADXqc3KAAAAA3NCSVQICAjb4U/gAAAA/1BMVEX///8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD//////9///7D//5n//4j//4b//3z//3b//2b//lr//1X/+m7/+lr/92T/90r/+Dr/9TL/7mT/7VP/7kr/8C//61f/6FX/50z/6Dn/7Bvw5XH/5DT/3zf/3jP/3wb/2yn+2Cf/1Rn/1RT/0wn1zyP3zwfVvTznuhLnuBLOtzvNpACion6woT+voD6ioGG+mROknEygmEmhlUKcjTWbii2XiTSnhgOVhCqXhCSRfyKTexeNeRqBXgB6Xwh5XgZbTBJQQQlJPAUhGQALCAAHAAAAAACfuyKiAAAAVXRSTlMAESIzRFVmd4iZqrvM3e7/////////////////////////////////////////////////////////////////////////////////////////////kIIiYgAAAAlwSFlzAAALEgAACxIB0t1+/AAAAB90RVh0U29mdHdhcmUATWFjcm9tZWRpYSBGaXJld29ya3MgOLVo0ngAAAEoSURBVCiRhZB7U4JQFMRFUFMETdSL70ABFUQwe2hlTy20NE/n+3+WLlGRyky/f+7O7uzcORuL/Q9zxDORQRogHeXHIZeDqAo/zeenmUOfheOCVID4QZC9KRAi3fL7PgeSuVqZJWD3AuGu/Ir4Vr7P7voJqJM14prUgdstPBGyQFwQ8iD89ZOgKLUzxMuaokAy9BlxUdFVC9FS9cqjGF6ZAt1wRoPtdjByDBVSYeGl5bpOd/PedVy39fxbSYNlD2277S3bNhX9ny3jotc0Kcb5heG/TU8MhsmAqeq63ph94KxBhdqHry1ZcSl3NE2TN4gbX3VkT/SH4UGpnlCqV4jXgVKA99ebk2LJp9jrBUKS53SYBEzGpwHD4bcYT2jAChCBQD/hEhFwsU8zIDa0z5rmxwAAAABJRU5ErkJggg%3D%3D';

        if ((is_bool($icon) === true) && ($icon == false))
            echo "<div style='width: $width; margin-bottom: 10px; background: $background; padding: 6px; height:auto; border: 2px solid $border; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;'>$text</div>";
        else
            echo "<div style='width: $width; margin-bottom: 10px; background: $background; padding: 6px; height:auto; border: 2px solid $border; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;'><img src='$icon' alt='Icon' style='padding-right: 6px; vertical-align: middle; width: 24px; height: 24px' />$text</div>";
    }

    public static function success($config = Array(), $text='') {

        isset($config['width']) ? $width = $config['width'] : $width = 'auto';
        isset($config['background']) ? $background = $config['background'] : $background = '#BCE954';
        isset($config['border']) ? $border = $config['border'] : $border = '#A0C544';
        isset($config['icon']) ? $icon = $config['icon'] : $icon = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9sDBAw5GoYTJm8AAAP/SURBVEjH7ZZrbFRVEMd/c+5uAVtpUYimhJZ3IgVRoLRBMBgphg+NftH4aFWMSRU0pJaHKBZsqrQUghXSEAha7AaDiV9IBDQSDTE+qOFhpdKHtRSDDbTQ17a7d++944fdLRaIkkr85CQ3Z27OnP/M/DMz58D/EpOq5vQh/zsaU28N8I7G8agqAHtaMp7Y0zLj4Aet8++K75t/A/5+w3hypnyMiLDv3MKXR/jGBfxWSq7PSjr2YWvWFAC5FVlUty4sNeJf3x1uNKqe+qzb5PaE9HpH7UXDcrDtTBpFGW2UnETSxixeC1J2ZaBeRfwxPMVnRqKqzxiAirr0mwavqEunKKMNgAkpSzZFXLvscn8zkCCqgqqo5xlsN/RFxBs4ZMpOT2TNrHMA7GrM+qSqIfMVgK11U2/oIG5b/duyatsdKO4J/R4DFTxP1PNEVPlGPXnstXv+6BKABwLI8uycI4ouNeIj7PRu6w5d3LB+dlMoDlx6Ygob5vxKyYlx/tTkuRW207OqN3ReRaxraf5y7b2tOVEqJ+DbeXahL8EkVQbDl5f22e0KQvKotKKxidMzt59JKSjMqD37du1UNsxpBiB1dNaO/nBnQV+4HRG/oACqqogI+wdsee4qleeQslOzs42Y78JOz2AIimqClSR3JE7quNTT9Oibc+u/Bdjb/PiRroG2R/rtjqhZtArj64HRI4JPrZrZrptPTWT9fa0AyMbjk8cI5jCYrEF8EFA14pe7k2dwqbdlc8qo1HlB+1JO0O5UwVxDi+7bNL/p+dKTU1HP4625LYM7AvDG99MSLTWbVFkdC2owOlVlbNIkCTm9BMOdQ1BBBPS90gUNhSW101CUjZnNQ1yb4h+m8252UzBim7WOK0sijumLOJZEHEsjjiWO65P27ja6gl1EHCv+adRGyksXNBQCOJ5cBw5gSrIaY5pq2aKzR13XzHNc0+C4ljiuheNa6rg+ruoWjmuJ65qN5Q/+8vq6YzMAGMS5RoZwuebrmVQs/plXP5+VZFlS7ikrQBBi0wyIFou3rjKnbsvqrzLY+tCZv23M60ZF4dFZbH+4jpWHZxtFngRqQEyUcxWgoGrZqd032/m+uFJTU4OIoBcUyOf+KwXei0+v2F9wMPMnT/QQyDhBC3bn/vjRzgPvSLKdpiI3HmV5eXlXMwgEAvFMDOACI1X1TqDTk4j3bNVyu3jVS2O7fecn517ecvrCqFqx8HuxMyNiqwX0xs6jqnHnalTVD6SoqpuXl4eqhkXkooiELRLsvSt38cKVXR2Vn352vGNkvW3hDwE2EFbVPqBXVbtVNQJ4gCciGr+E/ppBvN9NtKbUyc/PH9b9EAgEfICnqt4/GQ4H/L99DPwJyF3rj91PQwkAAAAASUVORK5CYII%3D';

        if ((is_bool($icon) === true) && ($icon == false))
            echo "<div style='width: $width; margin-bottom: 10px; background: $background; padding: 6px; height:auto; border: 2px solid $border; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;'>$text</div>";
        else
            echo "<div style='width: $width; margin-bottom: 10px; background: $background; padding: 6px; height:auto; border: 2px solid $border; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;'><img src='$icon' alt='Icon' style='padding-right: 6px; vertical-align: middle; width: 24px; height: 24px' />$text</div>";
    }

    public static function info($config = Array(), $text='') {

        isset($config['width']) ? $width = $config['width'] : $width = 'auto';
        isset($config['background']) ? $background = $config['background'] : $background = '#b2ccff';
        isset($config['border']) ? $border = $config['border'] : $border = '#80aaff';
        isset($config['icon']) ? $icon = $config['icon'] : $icon = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAMAAADXqc3KAAAAA3NCSVQICAjb4U/gAAABfVBMVEX///8AJGEAH1MAAAAAKWoAIlsAAAAAAAAAAAABBQkAAAAAOY8AM5kAAAAAM34AAAAAOY8BNoMAM5kBDh8CCxgAAwkAAAAAOY8BDh8VPXcUO3IAM5kUT6IhVqMXUqcQP4IPO3sAKWoAH1MiWKcFR6gAP6QAKWovbcgoZb0TUa0HSq4KRp8HRaEJRZ4AQ6wAM4H////19vrt7/HC2fi91PiyzfS4zee2yeCqyPGfu+SdueOctdmZtN6Tsd2Nq9lyrP+MqNSBqultp/5qpfuCn9B8oNZmoflinvhemvRdmfJmmcxZlfBjlNxUk+1QjOhKje5ZitVLiuVEie1Rh9VJh+RHheFAhu1Dgt9Kf88/ft07fd87e9g2ddQzddgxcdEpcNYnbtcpbM0jbNk2Z7YkZ8gcZ9MdZs8gZMcbYMEeWrYRWsQTWbwWWb0KVsoRVbkRU7YKVMMTUa0KULQEUMABTbwBSrUHSq4BSK4FR6gARLQAQ6wAP6QAO6MAM6QAK6D3k4/bAAAAf3RSTlMAERERIiIiM0RVVWZmZnd3iIiIiIiIiJmZqqqqu8zMzMzMzN3d3d3u7u7u7u7u7u7/////////////////////////////////////////////////////////////////////////////////////////////////////////X5xoHAAAAAlwSFlzAAALEgAACxIB0t1+/AAAAB90RVh0U29mdHdhcmUATWFjcm9tZWRpYSBGaXJld29ya3MgOLVo0ngAAAG3SURBVCiRVZH7V9MwHMWDxWRO6xRxPhAfyNwQhKDiC3DYaR/GRIMphXUMoujqOodMoRbBv920HRz5/HS/957vycn9AtDn7Ehpero0cg6cZCiS3DZrNpPR0H/2QKlpVo2qwqiazdLgkX/qPjMs26rHcd20LYPunc58bZxahDj130uvD+oOIRYZ19LggmtTSkn7KcZLbYdS5rhX0oUtwhijdOMJxi83CFUDkcnKecE482QYR2/e7u+G0mOc84tq4QYT3lYv2j84/Hv4J4qivZYn2E0NwIrrd3rdcHdhdhYvxmHY7YW+W4EAlv2gEwRBp/Mc4xdxkMjAL0OAyjJoJfxcxXjhVypbsowAqsiM9gcV/OgPFQTgaDPjaxK0+8Nd9cb1hp+y+U698SXTjWsQaHnpegmfPmK8+D2Vrjyjfohu+0wI4X2bx/jh53UuBFu7hZJK9AnhMCZePZqbe/yMq0L4hJ62iIa3uekQuryysvyeOCbrXkJZ7bnhqYZZrVkK06j5U1dzWv8gucKdbd9OLmitde8VjnyVIL04NvNgZ2dyZuyyjo79NMrrhWKxoOdP2GkEIUIQHtv/AL7Ke7VsM4mnAAAAAElFTkSuQmCC';

        if ((is_bool($icon) === true) && ($icon == false))
            echo "<div style='width: $width; margin-bottom: 10px; background: $background; padding: 6px; height:auto; border: 2px solid $border; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;'>$text</div>";
        else
            echo "<div style='width: $width; margin-bottom: 10px; background: $background; padding: 6px; height:auto; border: 2px solid $border; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;'><img src='$icon' alt='Icon' style='padding-right: 6px; vertical-align: middle; width: 24px; height: 24px' />$text</div>";
    }

    public static function edit($config = Array(), $text='') {

        isset($config['width']) ? $width = $config['width'] : $width = 'auto';
        isset($config['background']) ? $background = $config['background'] : $background = '#98AFC7';
        isset($config['border']) ? $border = $config['border'] : $border = '#737CA1';
        isset($config['icon']) ? $icon = $config['icon'] : $icon = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9sDBAw0IYK2sQYAAASASURBVEjHpZVbbFRFGMf/3zln9+zpvSzdLaW7FFMliw3oSiQiVMH6gAoNhtBglnh5MOIbQTEhkRAJRCIpiSbaqCRGIY2WIMbLQ4OmJYIUSxo0SBNpKdDSC5Ru290915nPB7YGKNQW5+nMSeb3m/ny/2aAGYwPi4oAAEfnzYu2VlU1tMRidZ3LlqkAcKKqCv97/Hz0KD4ClMPRaPMXwSA3lZVxc2Vl0+/xeAUAdFZX49s5c+4P3n7yGADgx7176z8Nh7mhuJgPBIP81ezZ/ENFRbI9Hn/5butoOnDzzE4Yj+3E36caV95A5Jd012Xu2rOb3KtX4SdiFUCurlNJYWGD5ThbVnd3WzMSAIB9dn8hu9dOphxv4Vjh03DEfHR9/gkuNTZCcV34FQUBTYNKtLJucLBl2gKr4z3oWogsu+99zx7Y5ma62bX6SYbXQUS2ItlxCr9u3gw5MgK/pg2rRItfHR7um1ivTFma9u0IPLoDlt0bF15ym2f1wbOHiEUG8uI+cMcLMB6YhZpjx7hw+XKZEWLXrfApT2C2b4exZA/ss3vzPHPgnGteijqZLgZAwhqAEGn4jQiEUsDX9WdJlq4/N/rnpcerN9ZmbuXc8wTGkj0AAGFf+8az+6Ou2cOKYhCkCyky8BnlIC2fye2n4pGPndHBi09Vb6zNfJ1I4D8F6bYtAIBM29ZXPHuoxrV6mZmJFBVSjEPx5UPzh8AiQ1LYIHhrqp9ZN9zbVIC6gwenjmmmbQtylu5Hum1rqXSTpx2zJ+KZV+AzKiCc63CtK9BzHwKzZM8dIuEkDwgn+bqq5ci5G8YnbVa784dwUwAA6Y0f8uyBiJu5CH/ugyAA0ktC0+dC0fLg2gNgYQ2xtN6JviQkMH7XUk8qUf7yz5A68cZbwrm+yjF7WPOXQNPDEO4ooASg51WyFCmwMImFt6l8Q3q47/CseyZxkmDkdH3Mk2KHm77AYEmBwsWQ7ggYHvS8hZBeClKYYPZ2la0fbO4/Uoa562/cUzCpRBIUV3IW6UQqDDkGlt7N1OilICIIaRJL5ziADwCAIads1MkpUn0hVnWfVryCEFyVBShQ/SUsRQYsrTGW4t3S2u5xACh7cWBmAlL9IVJ9BFUBAiGgdA18oRqwMHFT4OwLrz1/fPD7pdO6w24T8JVGzcjJDau+AEj1A4oKChSBQk+CymsJWl5zyXMduwCAKDUtwW19UP3EIqOyYk5T3doVz8cfWchGXj5B1UGaMUo+4yej6OHXet4ma/6++3yxIpFIQShcetrIzedNG1bzhY4jqfTgbw2pa2eW/NuIyb9mDj6Ybe9YLBZcsGDB5Wg0yqFQ6NDuHW/OZ2a6n81OMCk7UZg50NLSEuns7GwsLy/fVl9f/0dra2uuEIKISAVg3HnhMrMgIgBgZraISABwAdgArEQiIScEFQDWMnNM07QgMxcIIcJZsAYgcDdBFuQCEABuABgDMAjgPIDvEolEj5bV9xLRl0QUEELozOwHoDMzsvAAEfEtoZj4tpnZBEBEZAFwmNkBYFI2Zv8AMaYgzl0gP3IAAAAASUVORK5CYII%3D';

        if ((is_bool($icon) === true) && ($icon == false))
            echo "<div style='width: $width; margin-bottom: 10px; background: $background; padding: 6px; height:auto; border: 2px solid $border; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;'>$text</div>";
        else
            echo "<div style='width: $width; margin-bottom: 10px; background: $background; padding: 6px; height:auto; border: 2px solid $border; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;'><img src='$icon' alt='Icon' style='padding-right: 6px; vertical-align: middle; width: 24px; height: 24px' />$text</div>";
    }

    public static function help($config = Array(), $text='') {

        isset($config['width']) ? $width = $config['width'] : $width = 'auto';
        isset($config['background']) ? $background = $config['background'] : $background = '#ffffff';
        isset($config['border']) ? $border = $config['border'] : $border = '#000000';
        isset($config['icon']) ? $icon = $config['icon'] : $icon = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAAK8AAACvABQqw0mAAAAAd0SU1FB9sDBwwHGtVjkvwAAAP9SURBVEjHrZVbTBtUGMf/LQIbFiKQOQwwJeF+jUApl0KXTNtOKJkCmS9jTGSJzriHLcIWHZph4hDdjG8+oCNjwxh1L+wBcNyHjmXgBhu0JmNZYRFKaYHe2/P3QZZMooDA7+mcL+f7//Ody3f8sHH8AIQA2Lky92Kz6F5RPxlKdLpSZVdXV5vROD1ls9mcdrvdbTKZTMPDt35pbPy8+inDf0WyOqDMlmPg1jAAhHb39DbvVRUdGBn9Hd3dPXg4NQUKIiw8FHJ5DoqL92Nq6uGjQ5WV5QP9fTc3ZLBCmN5g+C08NCz23WPvYWZmGjJZMCRSKSQAhCBcLid8QuD0qTqqVCqh0+kKOzs7hjZiIOnt7buanJJcWqorxXOhoaAg7HY7IAH8pH7weNyQyUIAEFarFWfOfMTExMTpmJiX4gA419z/vNz8bJKsqDhIrWY/1WoN8/OV7OjoFFxhbGyc+/a9So1GS7VaS6VSRZKsr//44Go96erAiZMn3tTrDZh68ABenxdulxtVR6ool8sXq6qOlL/+RplaCHH33LnPYLUuQggfvF4PhoZ+hTxbrl2t98zqQERERILeoEdAYACEELDZbKiufkvS2Nh4+uLF734EgNSUlG9qa2u/9rg9ED7CTyrFvNmMkJDg8HUrMBqNI0qlEna7AyaTCSW6EtqWba5TdXVXACAqKjr5+PH3z7a3tzMwMACCPjgcDkRFRsJsNhs38gxCxsfvjXk8XhoMBpJkU9MX7wBAQUGBwmKx2gYGBkXmy1ksLFJRpdpLjUZLkiwvryhaUzkjKQUkASDowoWvDrW1ff+hRq3JASDRaLQqp9Pl+ennqyI9LZ2FyiIWFaqYkZbB2dlZdvf0Xlvj2q9LtNW66GxtvSxSU9KYn1fAgnwlMzOzODc3x3v3J/QAQjfdOjo6Oq8YDH8wPjaOuTm5zFPkMVeRy+XlZY6Mjo4CCAMAeXrGpvSDzOYFy9Gao1TIFVTIFczKzKLD6WBff38XABkAHFBrN13AHiFIVZGK2VnZTE9NY0tLixgbG7//pNHVn/zgP5OlGzDwCOEDSIDAgnkBSmWhZPjm8A8AHADwSVMjtoLk9sjojYmJSVaUlfP8l+eFw+kUCXHxSdgqO/wDQBKHKw8f8/l8dLnd9AnBSb3+sb+/fwy2iYjFpWVfw9kGERnxAl+M3iPu3LnLwcEbndui3tDwadnSso27w3cxITaOSfEJLH6tmBaLdQlA0Hr56x6yaX5+KTAwEFLp30vdLhd273qeTpfLuaV/+Sl2Tk7qH90eGWVpiY41b9cIh8PJS62Xm7Zli0hC9mxw9PXr3dcsVqttZubxn83N3zYA8N8Wg/SkxH90WgA7/k/+X8ZH/rnt6YUKAAAAAElFTkSuQmCC';

        if ((is_bool($icon) === true) && ($icon == false))
            echo "<div style='width: $width; margin-bottom: 10px; background: $background; padding: 6px; height:auto; border: 2px solid $border; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;'>$text</div>";
        else
            echo "<div style='width: $width; margin-bottom: 10px; background: $background; padding: 6px; height:auto; border: 2px solid $border; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;'><img src='$icon' alt='Icon' style='padding-right: 6px; vertical-align: middle; width: 24px; height: 24px' />$text</div>";
    }

    public static function textarea($config = Array(), $text='') {

        isset($config['width']) ? $width = $config['width'] : $width = 'auto';
        isset($config['background']) ? $background = $config['background'] : $background = '#ffffff';
        isset($config['border']) ? $border = $config['border'] : $border = '#000000';

        echo "<div style='width: $width; margin-bottom: 10px; background: $background; padding: 6px; height:auto; border: 2px solid $border; border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;'>$text</div>";
    }

}