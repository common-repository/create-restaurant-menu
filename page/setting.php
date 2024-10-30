<?php
/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 25/08/2019
 * Time: 11:11 PM
 */
defined('ABSPATH') || exit;
?>
<style>
        .tabeb {
            width:80%;
            padding: 6px 12px;
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #ddd;
        }
        .tabeb button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }
        .tabeb button:hover {
            background-color: #ccc;
        }
        .tabeb button.active {
            background-color: #ccc;
        }
        .tabebcontent {
            display: none;
            width:80%;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
        #divider {
            margin-top: 10px;

        }
</style>
<div class="tabeb">
    <button class="tabeblinks" onclick="CRMenu_openTab(event, 'setting')" id="defaultOpen"><b>Settings</b></button>
    <button class="tabeblinks" onclick="CRMenu_openTab(event, 'menusetting')"><b>Menu Setting</b></button>
    <button class="tabeblinks" onclick="CRMenu_openTab(event, 'shortcode')"><b>Shortcodes/Others</b></button>
    <button class="tabeblinks" onclick="CRMenu_openTab(event, 'linkedscript')"><b>Supporting Script</b></button>
</div>

<div id="setting" class="tabebcontent">
    <h1>Restaurant Stripe Cart Plugin</h1>
    <hr/>
    <div class="container">
        <div class="row">
            <form method="post">
                <div class="form-group" id="divider">
                    <label for="exampleInputStoreName" style="display:inline-block; width:200px; font-weight:bold;">Store Name</label>
                    <input type="text" id="storename" name="storename" class="form-control" size="40" value="<?php echo $storename; ?>"/>
                </div>
                <div class="form-group" id="divider">
                    <label for="exampleInput" style="display:inline-block; width:200px; font-weight:bold;">Currency Symbol (e.g: $,€)</label>
                    <input type="text" id="currencysymb" name="currencysymb" class="form-control" size="40" placeholder="$" value="<?php echo $currencysymb; ?>"/>
                </div>
                <br/>
                <button type="submit" class="btn btn-primary" style="width:100px; height:40px; font-size:1.5em; font-weight:bold;">Submit</button>
            </form>
        </div>
    </div>
    <hr/>
</div>
<script type="text/javascript">
            jQuery(document).ready(function($) {
                jQuery('.upload_image_button').on('click',function(){
                    $(".button-primary").prop('value', 'Save');
                    $(".button-primary").prop('disabled', false);
                });
                jQuery('.color-picker').each(function(){
                    $(".color-picker").wpColorPicker();
                });
                jQuery('.iris-picker').on('hover',function(){
                    $(".button-primary").prop('value', 'Save');
                    $(".button-primary").prop('disabled', false);
                });
            });
</script>

<div id="menusetting" class="tabebcontent">
    <div class="container">
        <div class="row">
            <form method="post">
                <h2>Menu Setting</h2>
                <hr/>
                <div class="form-group" id="divider">
                    <label for="exampleInput" style="display:inline-block; width:200px; font-weight:bold;">Menu Title Font Size in Pixel (e.g: 24)</label>
                    <input type="number" id="menutitlefontsize" name="menutitlefontsize" class="form-control" size="40" value="<?php echo $menutitlefontsize; ?>"/>
                </div>
                <div class="form-group" id="divider">
                    <label for="exampleInput" style="display:inline-block; width:200px; font-weight:bold;">Menu Other Font Size in Pixel (e.g: 20)</label>
                    <input type="number" id="menuotherfontsize" name="menuotherfontsize" class="form-control" size="40" value="<?php echo $menuotherfontsize; ?>"/>
                </div>
                <div class="form-group" id="divider">
                    <label for="exampleInput" style="display:inline-block; width:200px; font-weight:bold;">Other Button Bg Color</label>
                    <input class="widefat color-picker" id="otherbuttonbgcolor" name="otherbuttonbgcolor" type="color" value="<?php echo $otherbuttonbgcolor; ?>" />
                </div>
                <div class="form-group" id="divider">
                    <label for="exampleInput" style="display:inline-block; width:200px; font-weight:bold;">Allergens (e.g: Peanuts,Mustard)</label>
                    <input type="text" id="allergens" name="allergens" class="form-control" size="40" placeholder="Peanuts,SO2,Fish,Mustard,Lupin,Tree Nuts,Sesame,Molasses,Celery,Cereals with Gluten,Egg,Dairy,Crustaceans,Soybeans" value="<?php echo $allergens; ?>"/>
                </div>
                <div class="form-group" id="divider">
                    <label for="exampleInput" style="display:inline-block; width:200px; font-weight:bold;">Allergens Font Size in Pixel (e.g: 14)</label>
                    <input type="number" id="allergensfontsize" name="allergensfontsize" class="form-control" size="40" value="<?php echo $allergensfontsize; ?>"/>
                </div>
                <div class="form-group" id="divider">
                    <label for="exampleInput" style="display:inline-block; width:200px; font-weight:bold;">Allergen Font Color</label>
                    <input class="widefat color-picker" id="allergensfontcolor" name="allergensfontcolor" type="color" value="<?php echo $allergensfontcolor; ?>" />
                </div>
                <br/>
                <button type="submit" class="btn btn-primary" style="width:100px; height:40px; font-size:1.5em; font-weight:bold;">Submit</button>
            </form>
        </div>
    </div>
    <hr/>
</div>

<div id="shortcode" class="tabebcontent">
    <h1>Shortcode/Others for the web page.</h1>
    <hr/>
    <div class="container">
        <div class="row">
            <p>
                Please choose 'CRM Full Menu' from template for page menu to be implemented.<br/>
            </p>
        </div>
    </div>
    <hr/>
</div>

<div id="linkedscript" class="tabebcontent">
    <h1>Supporting Script</h1>
    <hr/>
    <div class="container">
        <div class="row">
            <form method="post">
                <p>Only entered field activates.</p>
                <hr/>
                <div class="form-group" id="divider">
                    <label for="exampleInput" style="display:inline-block; width:200px; font-weight:bold;">Activate jQuery:</label>
                    <select name="jquery" id="jquery">
                      <option value="false" <?php CRMenu_ifselected('false',$jquery); ?>>Deactivate</option>
                      <option value="true" <?php CRMenu_ifselected('true',$jquery); ?>>Activate</option>
                    </select>
                </div>
                <div class="form-group" id="divider">
                    <label for="exampleInput" style="display:inline-block; width:200px; font-weight:bold;">Activate Bootstrap Mini JS:</label>
                    <select name="bootstrapminjs" id="bootstrapminjs">
                      <option value="false" <?php CRMenu_ifselected('false',$bootstrapminjs); ?>>Deactivate</option>
                      <option value="true" <?php CRMenu_ifselected('true',$bootstrapminjs); ?>>Activate</option>
                    </select>
                </div>
                <div class="form-group" id="divider">
                    <label for="exampleInput" style="display:inline-block; width:200px; font-weight:bold;">Activate Fontawesome Mini CSS:</label>
                    <select name="fontawesomemincss" id="fontawesomemincss">
                      <option value="false" <?php CRMenu_ifselected('false',$fontawesomemincss); ?>>Deactivate</option>
                      <option value="true" <?php CRMenu_ifselected('true',$fontawesomemincss); ?>>Activate</option>
                    </select>
                </div>
                <div class="form-group" id="divider">
                    <label for="exampleInput" style="display:inline-block; width:200px; font-weight:bold;">Activate Bootstrap Mini CSS:</label>
                    <select name="bootstrapmincss" id="bootstrapmincss">
                      <option value="false" <?php CRMenu_ifselected('false',$bootstrapmincss); ?>>Deactivate</option>
                      <option value="true" <?php CRMenu_ifselected('true',$bootstrapmincss); ?>>Activate</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="width:100px; height:40px; font-size:1.5em; font-weight:bold;">Submit</button>
            </form>
        </div>
    </div>
    <hr/>
</div>

<script>
    function CRMenu_openTab(evt, cityName) {
        var i, tabebcontent, tabeblinks;
        tabebcontent = document.getElementsByClassName("tabebcontent");
        for (i = 0; i < tabebcontent.length; i++) {
            tabebcontent[i].style.display = "none";
        }
        tabeblinks = document.getElementsByClassName("tabeblinks");
        for (i = 0; i < tabeblinks.length; i++) {
            tabeblinks[i].className = tabeblinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
</script>
