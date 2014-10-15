<?php
    include dirname(__FILE__).'/../includes/sessionhandler.php';
    include dirname(__FILE__).'/../includes/getConfiguration.php';
?>

<script type="text/javascript">
    var prevDay = 0;
    var navEaster = Easter(new Date().getFullYear());

    function padout(number) { return (number < 10) ? '0' + number : number; }

    function Easter(Y)
    {
        var C = Math.floor(Y/100);
        var N = Y - 19*Math.floor(Y/19);
        var K = Math.floor((C - 17)/25);
        var I = C - Math.floor(C/4) - Math.floor((C - K)/3) + 19*N + 15;
        I = I - 30*Math.floor((I/30));
        I = I - Math.floor(I/28)*(1 - Math.floor(I/28)*Math.floor(29/(I + 1))*Math.floor((21 - N)/11));
        var J = Y + Math.floor(Y/4) + I + 2 - C + Math.floor(C/4);
        J = J - 7*Math.floor(J/7);
        var L = I - J;
        var M = 3 + Math.floor((L + 40)/44);
        var D = L + 28 - 31*Math.floor(M/4);

        return ("0" + D).slice(-2) + "." + ("0" + M).slice(-2) + "." + Y;
    }

    /**
     * Returns the week number for this date.  dowOffset is the day of week the week
     * "starts" on for your locale - it can be from 0 to 6. If dowOffset is 1 (Monday),
     * the week returned is the ISO 8601 week number.
     * @param int dowOffset
     * @return int
     */
    Date.prototype.getWeek = function (dowOffset) {
        dowOffset = typeof(dowOffset) == 'int' ? dowOffset : 0;
        var newYear = new Date(this.getFullYear(),0,1);
        var day = newYear.getDay() - dowOffset;
        day = (day >= 0 ? day : day + 7);
        var daynum = Math.floor((this.getTime() - newYear.getTime() -
        (this.getTimezoneOffset()-newYear.getTimezoneOffset())*60000)/86400000) + 1;
        var weeknum;

        if (day < 4) {
            weeknum = Math.floor((daynum+day-1)/7) + 1;
            if (weeknum > 52) {
                nYear = new Date(this.getFullYear() + 1,0,1);
                nday = nYear.getDay() - dowOffset;
                nday = nday >= 0 ? nday : nday + 7;
                weeknum = nday < 4 ? 1 : 53;
            }
        } else {
            weeknum = Math.floor((daynum+day-1)/7);
        }

        return weeknum;
    };

    //
    setInterval(function () {
                    var navWochentag = new Array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag");
                    var el_navClock = document.getElementById("navclock");
                    var el_navClockIcon = document.getElementById("navclockicon");
                    var navNow = new Date();
                    var navNowWeek = ("0" + navNow.getWeek(1)).slice(-2);
                    var navNowDay = ("0" + navNow.getDate()).slice(-2);
                    var navNowMonth = ("0" + eval(navNow.getMonth()+1)).slice(-2);
                    var navNowHour = ("0" + navNow.getHours()).slice(-2);
                    var navNowMinute = ("0" + navNow.getMinutes()).slice(-2);
                    var navNowSecond = ("0" + navNow.getSeconds()).slice(-2);

                    var navClockImage = "nav_clock.png"
                    if(navEaster == navNow.getDate() + "." + eval(navNow.getMonth()+1) + navNow.getFullYear())
                        navClockImage = "nav_easter.png";
                    else if(navNow.getDate() == 06 && eval(navNow.getMonth()+1) == 12)
                        navClockImage = "nav_stnicholas.png";
                    else if((navNow.getDate() == 25 || navNow.getDate() == 26) && eval(navNow.getMonth()+1) == 12)
                        navClockImage = "nav_christmas.png";
                    else if(navNow.getDate() == 24 && eval(navNow.getMonth()+1) == 12)
                        navClockImage = "nav_christmastree.png";
                    else if((navNow.getDate() == 31 && eval(navNow.getMonth()+1) == 12) || (navNow.getDate() == 01 && eval(navNow.getMonth()+1) == 01))
                        navClockImage = "nav_newyear.png";

                    if (el_navClock && el_navClockIcon) {
                        if(prevDay != navNowDay)
                            el_navClockIcon.innerHTML = "<img src=\"./img/" + navClockImage + "\" style=\"margin-top:-3px;\">";

                        el_navClock.innerHTML = "<b>" + navWochentag[navNow.getDay()] + "</b>, <b>" + navNowDay + "." + navNowMonth + "." + navNow.getFullYear() + "</b> &middot; <b>" + navNowHour + ":" + navNowMinute + "</b> Uhr &middot; KW " + navNowWeek;
                        prevDay = navNowDay;
                    }
                }, 1000);
</script>

<nav>
        <p class="infoline_clockicon" id="navclockicon"></p><p class="infoline_clock" id="navclock"></p><p class="infoline_r">Angemeldet als: <b><?php if (isset($_SESSION['username'])) { echo $_SESSION['username']; } ?></b> <a href="./login.php?cmd=logout"><img alt="Abmelden" title="Abmelden" src="./img/logout.png" style="margin-top:-3px;"></a></p>
        <ul>
            <li><a href="./index.php"><img src="./img/pinboard.png">Pinnwand</a></li>

            <li class="drop">
                <a href="#"><img src="./img/home.png">Haussteuerung</a>
                <div class="dropdownContain">
                    <div class="dropOut">
                        <div class="triangle"></div>
                        <ul>
                            <a href="./automation.php"><li><img src="./img/magnifier.png">Übersicht</li></a>
                            <!-- <a href="./scenario.php"><li><img src="./img/scenario.png">Szenarien</li></a> -->
                            <a href="./reports.php"><li><img src="./img/chart3.png">Auswertung</li></a>
                            <li><hr></li>
                            <a href="./webcam.php"><li><img src="./img/webcam.png">Webcams</li></a>
                        </ul>
                    </div>
                </div>
            </li>

            <?php if ($__CONFIG['fbox_address'] != "") { ?>
            <li><a href="./phone.php"><img src="./img/phone.png">Telefon</a></li>
            <?php } ?>

            <li class="drop">
                <a href="#"><img src="./img/weather.png">Wetter</a>

                <div class="dropdownContain">
                    <div class="dropOut">
                        <div class="triangle"></div>
                        <ul>
                            <a href="./weather.php"><li><img src="./img/magnifier.png">Übersicht</li></a>
                            <a href="./weather_rainradar.php"><li><img src="./img/radar.png">Regenradar</li></a>
                            <?php if ($__CONFIG['dwd_region'] != "") { ?>
                            <a href="./weather_warning.php"><li><img src="./img/warning.png">Warnungen</li></a>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </li>

            <li class="drop">
                <a href="#"><img src="./img/star.png">Diverses</a>

                <div class="dropdownContain">
                    <div class="dropOut">
                        <div class="triangle"></div>
                        <ul>
                            <a href="./sharefile.php"><li><img src="./img/upload.png">Bereitstellen</li></a>
                        </ul>
                    </div>
                </div>
            </li>

            <li class="drop">
                <a href="#"><img src="./img/tools.png">Einstellungen</a>
                <div class="dropdownContain">
                    <div class="dropOut">
                        <div class="triangle"></div>
                        <ul>
                            <?php if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) { ?>
                            <a href="configuration_users.php"><li><img src="./img/user.png">Benutzer</li></a>
                            <a href="configuration_settings.php"><li><img src="./img/gear.png">Allgemein</li></a>
                            <a href="configuration_automation.php"><li><img src="./img/home.png">Steuerung</li></a>
                            <a href="configuration_pinboard.php"><li><img src="./img/pinboard.png">Pinnwand</li></a>
                            <li><hr></li>
                            <?php } ?>
                            <a href="configuration_scheduler.php"><li><img src="./img/planer.png">Zeitplaner</li></a>
                            <a href="configuration_personalize.php"><li><img src="./img/personalize.png">Persönlich</li></a>
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
</nav>
