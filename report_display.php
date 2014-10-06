<?php
    include dirname(__FILE__).'/includes/dbconnection.php';
    include dirname(__FILE__).'/includes/sessionhandler.php';
    include dirname(__FILE__).'/includes/getConfiguration.php';
?>

<?php
    date_default_timezone_set('Europe/Paris');

    function displayRange($range, $type)
    {
        if ($type == "manual") {
            print("<select name=\"range\" onchange=\"javascript:rangeForm.submit();\">");
                print("<option value=\"3\" ".($range == 3 ? "selected" : "").">letzte 3 Einträge</option>");
                print("<option value=\"10\" ".($range == 10 ? "selected" : "").">letzte 10 Einträge</option>");
                print("<option value=\"30\" ".($range == 30 ? "selected" : "").">letzte 30 Einträge</option>");
                print("<option value=\"100\" ".($range == 100 ? "selected" : "").">letzte 100 Einträge</option>");
            print("</select>");
        } elseif ($type == "auto") {
            print("<select name=\"range\" onchange=\"javascript:rangeForm.submit();\">");
                print("<option value=\"1\" ".($range == 1 ? "selected" : "").">letzte 24 Stunden</option>");
                print("<option value=\"3\" ".($range == 3 ? "selected" : "").">letzte 3 Tage</option>");
                print("<option value=\"7\" ".($range == 7 ? "selected" : "").">letzte 7 Tage</option>");
                print("<option value=\"14\" ".($range == 14 ? "selected" : "").">letzte 14 Tage</option>");
                print("<option value=\"30\" ".($range == 30 ? "selected" : "").">letzte 30 Tage</option>");
                print("<option value=\"90\" ".($range == 90 ? "selected" : "").">letzte 90 Tage</option>");
                print("<option value=\"180\" ".($range == 180 ? "selected" : "").">letzte 180 Tage</option>");
                print("<option value=\"365\" ".($range == 365 ? "selected" : "").">letzte 365 Tage</option>");
            print("</select>");
        }
    }

    function displayReportYears($param_year, $mode, $reportid)
    {
        if($mode == "manual")
            $sql = "SELECT year(savedate) reportyear from reportdata where rid = ".$_GET['rid']." group by year(savedate) order by year(savedate) desc";
        else
            $sql = "SELECT year(timestamp) reportyear from device_data where deviceident = (select identifier from report_configuration join devices on devices.dev_id = report_configuration.value where rid = ".$reportid." and configstring = 'dev_id') group by year(timestamp) order by year(timestamp) desc";
        $result = mysql_query($sql);

        print("<select name=\"reportyear\" onchange=\"javascript:reportYearForm.submit();\">");
            while ($row = mysql_fetch_object($result)) {
                if($row->reportyear == date("Y"))
                    print("<option value=\"".date("Y")."\" ".($param_year == date("Y") ? "selected" : "").">aktuelles Jahr</option>");
                else
                    print("<option value=\"".$row->reportyear."\" ".($param_year == $row->reportyear ? "selected" : "").">".$row->reportyear."</option>");
            }
        print("</select>");
    }

    function calcAveragePerDayForYear($year)
    {
        $retVal = array();

        $avgPerDay = 0;

        $unitprice = 0;
        $sql = "select unitprice from reports where rid = ".$_GET['rid'];
        $result = mysql_query($sql);
        while ($row = mysql_fetch_object($result)) {
            $unitprice = doubleval($row->unitprice);
        }

        $sql = "select
                dayofyear(savedate) day,
                (
                    select dayofyear(savedate)-
                    ( select dayofyear(rdmin.savedate) from reportdata rdmin where rdmin.rid = reportdata.rid and year(rdmin.savedate) = year(reportdata.savedate) group by dayofyear(rdmin.savedate) order by rdmin.rd_id asc limit 0,1 )
                ) daydiff,
                max(data) data,
                (
                    ( max(data) - (select data from reportdata rdmin where rdmin.rid = reportdata.rid and year(rdmin.savedate) = year(reportdata.savedate) group by dayofyear(rdmin.savedate)order by rd_id asc limit 0,1) )
                ) datadiff,
                (
                    ( max(data) - (select data from reportdata rdmin where rdmin.rid = reportdata.rid and year(rdmin.savedate) = year(reportdata.savedate) group by dayofyear(rdmin.savedate)order by rd_id asc limit 0,1) ) / ( select dayofyear(savedate)-
                    ( select dayofyear(rdmin.savedate) from reportdata rdmin where rdmin.rid = reportdata.rid and year(rdmin.savedate) = year(reportdata.savedate) group by dayofyear(rdmin.savedate) order by rdmin.rd_id asc limit 0,1 ) )
                ) avgdata
                from reportdata
                where rid = ".$_GET['rid']." and year(savedate) = ".$year." group by dayofyear(savedate) order by savedate asc";

        $result = mysql_query($sql);
        while ($row = mysql_fetch_object($result)) {
            $avgPerDay += $row->avgdata;
        }

        $avgPerDay = $avgPerDay / mysql_num_rows($result);

        $retVal = array($avgPerDay,($avgPerDay*$unitprice));

        return $retVal;
    }

    function calcAveragePerMonthForYear($year)
    {
        $retVal = calcAveragePerDayForYear($year);

        $retVal[0] = $retVal[0]*30;

        $unitprice = 0;
        $sql = "select unitprice from reports where rid = ".$_GET['rid'];
        $result = mysql_query($sql);
        while ($row = mysql_fetch_object($result)) {
            $unitprice = doubleval($row->unitprice);
        }

        $retVal[1] = round($retVal[0]*$unitprice,2);

        return $retVal;
    }

    if ($_POST['cmd'] == "savedata" && !isset($_POST['rd_id']) && isset($_POST['rid'])) {
        $temp = explode(" ", $_POST['savedate']);
        $date = $temp[0];
        $time = $temp[1];
        $temp = explode(".", $date);
        $date = $temp[2]."-".$temp[1]."-".$temp[0];

        $startval = 0;
        if($_POST['startval'] == "on")
            $startval = 1;

        $sql = "insert into reportdata (savedate,data,rid,startval) values ('".$date." ".$time."', '".str_replace(",", ".", utf8_decode($_POST['data']))."', ".$_POST['rid'].", ".$startval.")";
        mysql_query($sql);
    } elseif ($_POST['cmd'] == "editdata" && isset($_POST['rd_id'])) {
        $temp = explode(" ", $_POST['savedate']);
        $date = $temp[0];
        $time = $temp[1];
        $temp = explode(".", $date);
        $date = $temp[2]."-".$temp[1]."-".$temp[0];

        $startval = 0;
        if($_POST['startval'] == "on")
            $startval = 1;
        $sql = "update reportdata set startval = 0 where rid = ".$_POST['rid'];
        mysql_query($sql);
        $sql = "update reportdata set savedate = '".$date." ".$time."', data = '".str_replace(",", ".", utf8_decode($_POST['data']))."', startval = ".$startval." where rd_id = ".$_POST['rd_id'];
        mysql_query($sql);
    } elseif ($_POST['cmd'] == "deletedata" && isset($_POST['rd_id'])) {
        $sql = "delete from reportdata where rd_id = ".$_POST['rd_id'];
        mysql_query($sql);
    }
?>

<?php
    $reportyear = date("Y");
    if(isset($_POST["reportyear"]))
        $reportyear = $_POST["reportyear"];

    $reportname = "";
    $reporttype = "";

    $sql = "select * from reports where rid = " . $_GET['rid'];
    $result = mysql_query($sql);
    while ($row = mysql_fetch_object($result)) {
        $reporttype = utf8_encode($row->type);
        $reportname = utf8_encode($row->name);
        $reportunit = utf8_encode($row->unit);
        $reportunitprice = doubleval($row->unitprice);
    }

    if($reporttype == "manual")
        $range = 3;
    else if($reporttype == "auto")
        $range = 1;
    if(isset($_POST["range"]))
        $range = $_POST["range"];

    switch ($range) {
        case '14':
            $modulo = 2;
            break;
        case '30':
            $modulo = 4;
            break;
        case '90':
            $modulo = 12;
            break;
        case '180':
            $modulo = 24;
            break;
        case '365':
            $modulo = 48;
            break;
        default:
            $modulo = 1;
            break;
    }

    if ($reporttype == "manual") {
        // value set
        $i = 0;
        //$sql = "select * from (select distinct date_format(date(dhl),'%d.%m.%Y') date, tn temp_min, tx temp_max, ws, pc from wetter_com_actual group by dhl order by d desc limit 0,".$range.") data order by date asc";
        $sql = "select *, date_format(savedate, '%d.%m.%Y') formatted_savedate from reportdata where rid = " . $_GET['rid'] . " and year(savedate) = ".$reportyear." order by savedate desc limit 0,".$range."";
        $result = mysql_query($sql);

        while ($row = mysql_fetch_object($result)) {
            $valueset_data[] = array($i, $row->data);

            if($i%$modulo == 0)
                $valueset_labels[] = array($i, $row->formatted_savedate);
            $i++;
        }

        // diff set
        $sql = "select
                    dayofyear(savedate) day,
                    (
                        select dayofyear(savedate)-
                        ( select dayofyear(rdmin.savedate) from reportdata rdmin where rdmin.rid = reportdata.rid and year(rdmin.savedate) = year(reportdata.savedate) group by dayofyear(rdmin.savedate) order by rdmin.rd_id asc limit 0,1 )
                    ) daydiff,
                    max(data) data,
                    (
                        ( max(data) - (select data from reportdata rdmin where rdmin.rid = reportdata.rid and year(rdmin.savedate) = year(reportdata.savedate) group by dayofyear(rdmin.savedate)order by rd_id asc limit 0,1) )
                    ) datadiff,
                    (
                        ( max(data) - (select data from reportdata rdmin where rdmin.rid = reportdata.rid and year(rdmin.savedate) = year(reportdata.savedate) group by dayofyear(rdmin.savedate)order by rd_id asc limit 0,1) ) / ( select dayofyear(savedate)-
                        ( select dayofyear(rdmin.savedate) from reportdata rdmin where rdmin.rid = reportdata.rid and year(rdmin.savedate) = year(reportdata.savedate) group by dayofyear(rdmin.savedate) order by rdmin.rd_id asc limit 0,1 ) )
                    ) avgdata,
                    date_format(savedate, '%d.%m.%Y') formatted_savedate
                    from reportdata
                    where rid = ".$_GET['rid']." and year(savedate) = ".$reportyear." group by dayofyear(savedate) order by savedate asc";

        $result = mysql_query($sql);

        $i=0;
        $diffset_data = array();
        $diffset_labels = array();
        while ($row = mysql_fetch_object($result)) {
            $diffset_data[] = array($i, $row->avgdata);
            $diffset_labels[] = array($i, $row->formatted_savedate);
            $i++;
        }
    } elseif ($reporttype == "auto") {
        $data = array();
        $data_labels = array();
        $data_series_labels = array();
        $graph_labels = array();
        $graph_colors = array();

        $sql = "select configstring name from report_configuration where value = 'on' and rid = " . $_GET['rid'];
        $result = mysql_query($sql);
        $i=0;
        while ($enabled_values = mysql_fetch_object($result)) {
            $data[$i] = array();
            $data_labels[$i] = array();
            $data_series_labels[$i] = array();

            // get value translation
            $translation = utf8_encode($enabled_values->name);
            $sql = "select value name from configuration where configstring = '@".utf8_encode($enabled_values->name)."' and dev_id = (select report_configuration.value from report_configuration where rid = ".$_GET['rid']." and configstring = 'dev_id')";
            $result2 = mysql_query($sql);
            while ($trans = mysql_fetch_object($result2)) {
                $translation = utf8_encode($trans->name);
            }
            $graph_labels[$i] = $translation;

            // get value unit
            $unit = "";
            $sql = "select distinct valueunit from device_data where deviceident = (select identifier from report_configuration join devices on devices.dev_id = report_configuration.value where rid = ".$_GET['rid']." and configstring = 'dev_id') and valuename = '".utf8_encode($enabled_values->name)."'";
            $result2 = mysql_query($sql);
            while ($valunit = mysql_fetch_object($result2)) {
                $unit = " [".utf8_encode($valunit->valueunit)."]";
            }
            $graph_labels[$i] = $graph_labels[$i].$unit;

            // get graph color
            $selected_color = "#FFFFFF";
            $result2 = mysql_query("select value from report_configuration where rid = ".$_GET['rid']." and configstring = '".utf8_encode($enabled_values->name)."_color'");
            while ($color = mysql_fetch_object($result2)) {
                $selected_color = utf8_encode($color->value);
            }
            $graph_colors[$i] = $selected_color;

            // get data
            $sql = "select *, DATE_FORMAT(timestamp, '%d.%m.%Y %T') timestamp_german from device_data where deviceident = (select identifier from report_configuration join devices on devices.dev_id = report_configuration.value where rid = ".$_GET['rid']." and configstring = 'dev_id') and valuename = '".$enabled_values->name."' and year(timestamp) = ".$reportyear." and timestamp between now() - interval ".$range." day and now() order by timestamp_unix";
            $result2 = mysql_query($sql);
            $j = 0;
            while ($value = mysql_fetch_object($result2)) {
                $data[$i][] = array($j, $value->value);
                $data_series_labels[$i][$j] = array($value->timestamp_german);
                if ($j%72 == 0) { // every 6 hours
                    $data_labels[$i][] = array($j, str_replace(" ", "<br>", $value->timestamp_german));
                }
                $j++;
            }
            $i++;
        }

    }

    print_r($data_)
?>

<html>
    <head>
        <meta charset="UTF-8" />

        <link rel="stylesheet" href="./css/style.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/report.css" type="text/css" media="screen" title="no title" charset="UTF-8">
        <link rel="stylesheet" href="./css/nav.css" type="text/css" media="screen" title="no title" charset="UTF-8">

        <?php include dirname(__FILE__).'/includes/getUserSettings.php'; ?>

        <script type="text/javascript" src="./js/jquery.min.js"></script>
        <script language="javascript" type="text/javascript" src="./js/flot/jquery.flot.js"></script>

        <script type="text/javascript">
            $(function () {
                $(".graph").bind("plothover", function (event, pos, item) {
                    //if ($("#enableTooltip:checked").length > 0) {
                        if (item) {
                            if (previousPoint != item.dataIndex) {
                                previousPoint = item.dataIndex;

                                $("#tooltip").remove();
                                var x = item.datapoint[0].toFixed(2),
                                y = item.datapoint[1].toFixed(2);

                                if(item.series.label)
                                    showTooltip(item.pageX, item.pageY, "<div id='label'>"+item.series.label[item.dataIndex] + "</div><div id='value'>" + y + "</div>");
                                else
                                    showTooltip(item.pageX, item.pageY, y);
                            }
                        } else {
                            $("#tooltip").remove();
                            previousPoint = null;
                        }
                    //}
                });

                function showTooltip(x, y, contents)
                {
                    $("<div id='tooltip'>" + contents + "</div>").css({
                        top: y + 5,
                        left: x + 5
                    }).appendTo("body").fadeIn(200);
                }

                <?php
                if ($reporttype == "manual") {
                ?>
                    // get data
                    var valueset_data = { "label": "", "data": <?php echo json_encode($valueset_data); ?>, "color": "#888888" };
                    var diffset_data = { "label": "", "data": <?php echo json_encode($diffset_data); ?>, "color": "#d97c00" };

                    // define options
                    var valueset_options = {
                                    series: 	{
                                                    lines: { show: true },
                                                    points: { show: true, radius: 2 }
                                                },
                                    xaxis: 		{
                                                    ticks: <?php echo json_encode($valueset_labels); ?>
                                                },
                                    yaxis: 		{
                                                    tickDecimals: 2,
                                                },
                                    grid:   	{
                                                    borderWidth: { top: 1, right: 1, bottom: 1, left: 1 },
                                                    hoverable: true
                                                },
                                    legend: 	{
                                                    show: false
                                                }
                                  };
                    var diffset_options = {
                                    series: 	{
                                                    lines: { show: true },
                                                    points: { show: true, radius: 2 }
                                                },
                                    xaxis: 		{
                                                    ticks: <?php echo json_encode($diffset_labels); ?>
                                                },
                                    yaxis: 		{
                                                    tickDecimals: 2,
                                                },
                                    grid:   	{
                                                    borderWidth: { top: 1, right: 1, bottom: 1, left: 1 },
                                                    hoverable: true
                                                },
                                    legend: 	{
                                                    show: false
                                                }
                                  };

                    // draw graphs
                    $.plot($("#valuetrend"), [ valueset_data ] , valueset_options);
                    $.plot($("#difftrend"), [ diffset_data ] , diffset_options);
                <?php
                } elseif ($reporttype == "auto") {
                    for ($i=0; $i < count($data); $i++) {
                        //for ($j=0; $j < count($data[$i]); $j++) {
                            print('var data_'.$i.' = { "label": '.json_encode($data_series_labels[$i]).', "data": '.json_encode($data[$i]).', "color": "'.$graph_colors[$i].'" };');
                            print('var data_'.$i.'_options = {
                                    series: 	{
                                                    lines: { show: true },
                                                    points: { show: true, radius: 0 },
                                                },
                                    xaxis: 		{
                                                    ticks: '.json_encode($data_labels[$i]).'
                                                },
                                    yaxis: 		{
                                                    tickDecimals: 2
                                                },
                                    grid:   	{
                                                    borderWidth: { top: 1, right: 1, bottom: 1, left: 1 },
                                                    hoverable: true
                                                },
                                    legend: 	{
                                                    show: false
                                                }
                                  };');
                        //}
                        print('var graph_'.$i.' = "#graph_'.$i.'";');
                        print('$.plot($("#graph_'.$i.'"), [ data_'.$i.' ] , data_'.$i.'_options);');
                    }
                }
                ?>
            });
        </script>

        <link rel="apple-touch-icon" href="./img/favicon.ico"/>
        <link rel="shortcut icon" type="image/x-icon" href="./img/favicon.ico" />
        <title><?php echo $__CONFIG['main_sitetitle'] ?> - Auswertung <?php echo $reportname." ".$reportyear; ?> (letzte <?php echo $range." ".($reporttype == "manual" ? "Einträge" : "Tage");?>)</title>
    </head>
<body>
    <?php require(dirname(__FILE__).'/includes/nav.php'); ?>

    <section class="main_report_graph">
        <div id="headline"><h1><span><?php echo $reportname; ?></span></h1></div><div id="reportyear"><form method="POST" enctype="multipart/form-data" name="yearForm" id="reportYearForm"><?php displayReportYears($reportyear, $reporttype, $_GET['rid']); ?></form></div><div id="range"><form method="POST" enctype="multipart/form-data" name="rangeForm" id="rangeForm"><?php displayRange($range, $reporttype); ?></form></div>
            <br>
            <div id="toolbar">
                <a href="reports.php"><div id="left"><img src="./img/back.png">&nbsp;&nbsp;Zurück</div></a>
            </div>

            <?php
            if ($reporttype == "manual") {
            ?>
            <h2>Grafik - letzte <?php echo $range; ?> Einträge</h2>
            <table id="flot_200">
                <tr>
                    <td id="xaxis_label"><div>Wertverlauf</div></td>
                    <td id="valuetrend" class="graph"></td>
                </tr>
            </table>
            <table id="flot_200">
                <tr>
                    <td id="xaxis_label"><div>Differenzverlauf</div></td>
                    <td id="difftrend" class="graph"></td>
                </tr>
            </table>
            <?php
            } elseif ($reporttype == "auto") {
                print("<h2>Grafik - letzte ".$range." Tage</h2>");
                for ($i=0; $i<count($graph_labels); $i++) {
                    print("<table id=\"flot_200\">");
                    print("<tr>");
                        print("<td id=\"xaxis_label\"><div>".$graph_labels[$i]."</div></td>");
                        print("<td id=\"graph_".$i."\" class=\"graph\"></td>");
                    print("</tr>");
                    print("</table>");
                }
            }
            ?>

            <?php
            if ($reporttype == "manual") {
            ?>
            <h2>Errechnete Werte - letzte <?php echo $range; ?> Einträge</h2>
            <?php
                $sql = "select * from reportdata where rid = ".$_GET['rid']." and year(savedate) = ".$reportyear." order by savedate asc limit 0,".$range."";
                $result = mysql_query($sql);

                $items = mysql_num_rows($result);

                $sum = 0.0;
                if($items > 0)
                    $min = 9999999999999.0;
                else
                    $min = 0.0;
                $max = 0.0;
                $firstvalue = 0.0;

                $i = 0;

                while ($row = mysql_fetch_object($result)) {
                    if($row->data < $min)
                        $min = doubleval($row->data);

                    if($row->data > $max)
                        $max = doubleval($row->data);

                    $sum += doubleval($row->data);
                    $i++;
                }

                if(mysql_num_rows($result) > 0 && $items > 1)
                    $avg = round($sum / $items,2);
                else
                    $avg = 0.0;

                $usagePerDay = calcAveragePerDayForYear($reportyear);
                $usagePerMonth = calcAveragePerMonthForYear($reportyear);
                echo "<div id=\"text\">Minimum:</div><div id=\"value\">".doubleval($min)." ".$reportunit."</div>";
                echo "<div id=\"text\">Maximum:</div><div id=\"value\">".doubleval($max)." ".$reportunit."</div>";
                echo "<div id=\"text\">Durchschnittl. Differenz / Tag:</div><div id=\"value\">".round($usagePerDay[0],2)." ".$reportunit."&nbsp;&nbsp;(".round($usagePerDay[1],2)." €)</div>";
                echo "<div id=\"text\">Durchschnittl. Differenz / Monat:</div><div id=\"value\">".round($usagePerMonth[0],2)." ".$reportunit."&nbsp;&nbsp;(".round($usagePerMonth[1],2)." €)</div>";
            }
            ?>

            <?php
            if ($reporttype == "manual") {
            ?>
            <h2>Erfasste Werte</h2>
            <div id="header">
                <div id="number">#</div>
                <div id="date">Datum</div>
                <div id="data">Wert</div>
                <div id="datadiff">Differenz</div>
                <div id="startval">Startwert</div>
                <div id="action">&nbsp;</div>
            </div>
                <div id="listitem">
                    <div id="number">&nbsp;</div>
                    <form method="POST" enctype="multipart/form-data" name="saveDataForm" id="saveDataForm">
                        <div id="date"><input name="savedate" value="<?php echo date('d.m.Y H:i:s'); ?>"></div>
                        <div id="data"><input name="data"></div>
                        <div id="datadiff">&nbsp;</div>
                        <div id="startval">&nbsp;</div>
                        <input type="hidden" name="rid" value="<?php echo $_GET['rid']; ?>">
                        <input type="hidden" name="cmd" value="savedata">
                    </form>
                    <div id="action">
                        <a href="#" onclick="javascript:document.saveDataForm.submit()" title="Wert abspeichern"><img src="./img/save.png"></a>
                    </div>
                </div>
            <?php
                $i=1;
                $data_prev=0;
                $sql = "select * from reportdata where rid = ".$_GET['rid']." and year(savedate) = ".$reportyear." order by savedate asc";
                $result = mysql_query($sql);
                while ($row = mysql_fetch_object($result)) {
                    $temp = explode(" ", $row->savedate);
                    $date = $temp[0];
                    $time = $temp[1];
                    $temp = explode("-", $date);
                    $date = $temp[2].".".$temp[1].".".$temp[0];

                    $data_diff = round(doubleval($row->data) - doubleval($data_prev),2);

                    echo "<div id=\"listitem\">";
                        echo "<div id=\"number\">".$i."</div>";
                        echo "<form method=\"POST\" enctype=\"multipart/form-data\" name=\"editDataForm".$row->rd_id."\" id=\"editDataForm\">";
                            echo "<div id=\"date\"><input name=\"savedate\" value=\"".$date." ".$time."\" ".($reporttype == "auto" ? "readonly" : "")."></div>";
                            echo "<div id=\"data\"><input name=\"data\" value=\"".utf8_encode($row->data)."\" ".($reporttype == "auto" ? "readonly" : "")."></div>";
                            echo "<div id=\"datadiff\"><input value=\"".$data_diff."\" readonly></div>";
                            echo "<div id=\"startval\"><input name=\"startval\" type=\"checkbox\" ".($row->startval == 1 ? "checked" : "")."></div>";
                            echo "<input type=\"hidden\" name=\"cmd\" value=\"editdata\">";
                            echo "<input type=\"hidden\" name=\"rd_id\" value=\"".$row->rd_id."\">";
                            echo "<input type=\"hidden\" name=\"rid\" value=\"".$row->rid."\">";
                        echo "</form>";
                        echo "<form method=\"POST\" enctype=\"multipart/form-data\" name=\"deleteDataForm".$row->rd_id."\" id=\"deleteDataForm\">";
                            echo "<input type=\"hidden\" name=\"cmd\" value=\"deletedata\">";
                            echo "<input type=\"hidden\" name=\"rd_id\" value=\"".$row->rd_id."\">";
                        echo "</form>";
                        echo "<div id=\"action\">";
                            if($reporttype != "auto")
                                echo "<a href=\"#\" onclick=\"javascript:document.editDataForm".$row->rd_id.".submit()\" title=\"Wert abspeichern\"><img src=\"./img/save.png\"></a>&nbsp;&nbsp;&nbsp;&nbsp;";

                            echo "<a href=\"javascript:document.deleteDataForm".$row->rd_id.".submit()\" title=\"Wert löschen\" onclick=\"javascript:return confirm('Soll der Wert wirklich gelöscht werden ?');\"><img src=\"./img/delete.png\"></a>";
                        echo "</div>";
                    echo "</div>";
                    $i++;
                    $data_prev = $row->data;
                }
            ?>
            <?php
            }
            ?>
            <div id="spacer">&nbsp;</div>
    </section>
</body>
</html>
