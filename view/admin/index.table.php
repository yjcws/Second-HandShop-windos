<?php
include $_SERVER['DOCUMENT_ROOT']."/controller/page.class.php";




$WebWhere = array(
    'table' => 'webconfig',
    'field' => '*',
);

$WebRes = $helper->getOne($WebWhere);

//echo "<pre>";
//var_dump($WebRes);
//echo "</pre>";
//

?>


<div id="content_body">

    <div class="body-center"> <font style="margin-left: 50px" size="5">当前位置 >> 基本设置</font></div>

    <hr>


    <fieldset style="border-radius:5px;" >
        <form id="form1" name="form1" method="post" action="../../public/Admin/Admin.index.php">
            <table width="100%" border="0" cellspacing="0">
                <tr>
                    <td height="30" colspan="2" bordercolor="#000000" bgcolor="#999999">基本配置变量信息：</td>
                </tr>
                <tr>
                    <td width="15%" height="30" align="right" valign="middle" bordercolor="#000000">网站名称：</td>
                    <td width="85%" height="30" bordercolor="#000000"><label>
                            <input name="webname" type="text" size="30" value="<?php echo $WebRes['webname']?>"/>
                            <span class="STYLE4">                    网站名称</span></label></td>
                </tr>
                <tr>
                    <td height="30" align="right" valign="middle" bordercolor="#000000">网站地址：</td>
                    <td height="30" bordercolor="#000000"><label>
                            <input name="webUrl" type="text" size="30" value="<?php echo $WebRes['webUrl']?>"/>
                            <span class="STYLE4">格式：http://xxx.xxx.xxx                        </span></label></td>
                </tr>
                <tr>
                    <td height="30" align="right" valign="middle" bordercolor="#000000">是否启动会员注册：</td>
                    <td height="30" bordercolor="#000000"><label>
                            <input name="register" type="radio" value="1"
                                   <?php
                                   if ($WebRes['register']==1){
                                       echo "checked='checked'";
                                   }
                                   ?>
                                    />
                            是
                            <input type="radio" name="register" value="0"
                                <?php
                                if ($WebRes['register']==0){
                                    echo "checked='checked'";
                                }
                                ?>
                            />
                            否　　　　　　　　　　<span class="STYLE4">会员注册状况</span></label></td>
                </tr>
                <tr>
                    <td height="58" align="right" valign="middle" bordercolor="#000000">网站版权：</td>
                    <td height="58" bordercolor="#000000"><label>
                            <textarea name="copyright" cols="35" rows="8"><?php echo $WebRes['copyright']?></textarea>
                        </label></td>
                </tr>
                <tr>
                    <td height="30" align="right" valign="middle" bordercolor="#000000">&nbsp;</td>
                    <td height="30" bordercolor="#000000"><label></label>
                        <label>
                            <input type="submit" name="Submit" value="提交" />
                            <input type="reset" name="reset" value="重置" />
                        </label></td>
                </tr>

            </table>
        </form>
    </fieldset>

</div>

<div id="floor"></div>

