   
<?php
    $cs = Ycms::app()->getClientScript();
    $cs->registerScriptFile(YHtml::jsUrl('jquery.js'));

    $cs->registerScriptFile(YHtml::jsUrl('jstree/jquery.jstree.js'));
?>




<style type="text/css" >
    .tree {overflow:auto; height: 100%; }
    ul.jstree { width:700px; margin:0px auto 15px auto; padding:0; }
    ul.jstree li { margin:0; padding:2px 0; }
    ul.jstree li a { color:#3B5998; text-decoration:underline; }
    .jstree ins{cursor: pointer}
</style>
<div id="tree" class="tree">
    <?php
        $this->widget('ycms.widget.YTreeHelp', array(
                'data' => $tree,
        ));
    ?>
</div>

<script type="text/javascript" >
    $(function () {
        
        
        $('#tree a').click(function()
        {
            $("#rightMain").attr("src",$(this).attr("href"));
        })
        
        

        $("#tree").jstree({ 
            // List of active plugins
            "plugins" : [ 
                "themes","html_data","ui","dnd","types",
            ],
            // Using types - most of the time this is an overkill
            // read the docs carefully to decide whether you need types
            "types" : {
                "types" : {
                    // The default type
                    "menu" : {
                        // I want this type to have no children (so only leaf nodes)
                        // In my case - those are files
                        "valid_children" : [ "link"],
                        // If we specify an icon for the default type it WILL OVERRIDE the theme icons
                        "icon" : {
                            "image" : "<?php echo YHtml::imageUrl('icon/folder.png') ?>" 
                        }                                      
                    },
                    // The `folder` type
                    "link" : {
                        // can have files and other folders inside of it, but NOT `drive` nodes
                        "valid_children" : [ "link"],
                        "icon" : {
                            "image" : "<?php echo YHtml::imageUrl('icon/file.png') ?>" 
                        }
                    }
                }
            },
            // the core plugin - not many options here
            "core" : { 
                // just open those two nodes up
                // as this is an AJAX enabled tree, both will be downloaded from the server
                "initially_open" : [ <?php echo implode($sizeNode, ',') ?>  ] 
            }
        })
        .bind("move_node.jstree", function (e, data) {
            data.rslt.o.each(function (i) {
                $.ajax({
                    async : false,
                    type: 'POST',
                    url: "<?php echo $this->createUrl('link/jsTreeMove') ?>",
                    data : { 
                        "operation" : "move_node", 
                        "id" : $(this).attr("id").replace("node_",""), 
                        "ref" : data.rslt.cr === -1 ? 1 : data.rslt.np.attr("id").replace("node_",""), //新的父级菜单
                        "position" : data.rslt.cp + i,//新的位置，i为空
                        "title" : data.rslt.name,
<?php
    $request = Yii::app()->request;
    if ($request->enableCsrfValidation)
        echo "'" . $request->csrfTokenName . '\':\'' . $request->getCsrfToken() . '\','
        ?>
                                "copy" : data.rslt.cy ? 1 : 0
                                                
                                                
                                                
                            },
                            success : function (r) {
                                r = jQuery.parseJSON(r);
                                if(!r.status) {
                                    $.jstree.rollback(data.rlbk);
                                }
                                else {
                                    $(data.rslt.oc).attr("id", "node_" + r.id);
                                    if(data.rslt.cy && $(data.rslt.oc).children("UL").length) {
                                        data.inst.refresh(data.inst._get_parent(data.rslt.oc));
                                    }
                                }
                                $("#analyze").click();
                            }
                        });
                    });
                });
            });
</script>