<?php
    include dirname(__FILE__).'/../includes/dbconnection.php';
    include dirname(__FILE__).'/../includes/sessionhandler.php';
    include dirname(__FILE__).'/../includes/getConfiguration.php';

    function displayTickInterval($tick)
    {
        print("<select name=\"tick_interval\">");
            print("<option value=\"5m\" ".($tick == "5m" ? "selected" : "").">5 Minütlich</option>");
            print("<option value=\"60m\" ".($tick == "60m" ? "selected" : "").">halb Stündlich</option>");
            print("<option value=\"1h\" ".($tick == "1h" ? "selected" : "").">Stündlich</option>");
            print("<option value=\"1d\" ".($tick == "1d" ? "selected" : "").">Täglich</option>");
            print("<option value=\"1M\" ".($tick == "1M" ? "selected" : "").">Monatlich</option>");
            print("<option value=\"1Y\" ".($tick == "1Y" ? "selected" : "").">Jährlich</option>");
        print("</select>");
    }

    if (isset($_GET['dev_id']) && $_GET['dev_id'] != null) {
        $result = mysql_query("select identifier from devices where dev_id = " . $_GET['dev_id']);
        while ($device_identifier = mysql_fetch_object($result)) {
            $result2 = mysql_query("select distinct valuename, valueunit from device_data where deviceident = '".$device_identifier->identifier."' order by valuename");

            if (mysql_num_rows($result2) > 0) {
                $i=1;
                print("<div id=\"headline\"><div id=\"value_label\">Übermittelter Wert</div><div id=\"value_unit\">Einheit</div><div id=\"value_color\">Farbe</div><div id=\"value_status\">Verw.</div></div>");

                while ($valuerow = mysql_fetch_object($result2)) {
                    $translation = utf8_encode($valuerow->valuename);
                    $result3 = mysql_query("select value from configuration where dev_id = ".$_GET['dev_id']." and configstring = '@".utf8_encode($valuerow->valuename)."'");
                    while ($trans = mysql_fetch_object($result3)) {
                        $translation = utf8_encode($trans->value);
                    }

                    $enabled = "";
                    $result3 = mysql_query("select value from report_configuration where rid = ".$_GET['rid']." and configstring = '".utf8_encode($valuerow->valuename)."'");
                    while ($en = mysql_fetch_object($result3)) {
                        $enabled = utf8_encode($en->value);
                    }

                    $selected_color = "#FFFFFF";
                    $result3 = mysql_query("select value from report_configuration where rid = ".$_GET['rid']." and configstring = '".utf8_encode($valuerow->valuename)."_color'");
                    while ($color = mysql_fetch_object($result3)) {
                        $selected_color = utf8_encode($color->value);
                    }

                    /*$selected_color = "5m";
                    $result3 = mysql_query("select value from report_configuration where rid = ".$_GET['rid']." and configstring = '".utf8_encode($valuerow->valuename)."_color'");
                    while ($color = mysql_fetch_object($result3)) {
                        $selected_color = utf8_encode($color->value);
                    }*/

                    print("<div id=\"value_row\">
                            <div id=\"value_label\">".$translation."</div>
                            <div id=\"value_unit\">".utf8_encode($valuerow->valueunit)."</div>
                            <div id=\"value_color\"><input class=\"color {hash:true}\" name=\"".utf8_encode($valuerow->valuename)."_color\" value=\"".$selected_color."\"></div>
                            <div id=\"value_interval\"></div>
                            <div id=\"status\"><input title=\"In diesem Bericht verwenden\" type=\"checkbox\" name=\"".utf8_encode($valuerow->valuename)."\" ".($enabled == "on" ? "checked" : "")."></div>
                        </div>");
                    $i++;
                }
            } else {
                print("<div id=\"value_row\"><div id=\"message\">Es wurden noch keine Werte in der Datenbank erfasst! Bitte einen Moment warten und <a href=\"javascript:showIdentifierListForDataCollector(".$_GET['rid'].",".$_GET['dev_id'].");\">aktualisieren</a> oder die Kennung in der <a href=\"configuration_automation.php\">Gerätekonfiguration</a> überprüfen.</div></div>");
            }
        }
    }
?>
