<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('cake.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>

        <div class="top-bar-section">
            <ul class="name">
                <li><?= $this->Html->link(__('Users'), ['controller' => 'users', 'action' => 'index']) ?></li>
            </ul>
        </div>

        <div class="top-bar-section">
            <ul class="name">
                <li><?= $this->Html->link(__('Contacts'), ['controller' => 'contacts', 'action' => 'index']) ?></li>
            </ul>
        </div>

        <div class="top-bar-section">
        <ul class="name">
            <li><?= $this->Html->link(__('Groups'), ['controller' => 'groups', 'action' => 'index']) ?></li>
        </ul>
        </div>

        <div class="top-bar-section">
            <ul class="name">
                <li><?= $this->Html->link(__('E-mail'), ['controller' => 'contacts', 'action' => 'email']) ?></li>
            </ul>
        </div>

        <div class="top-bar-section">
            <ul class="right">
                <li><?= $this->Html->link(__('Logout'), ['controller' => 'users', 'action' => 'logout']) ?></li>
            </ul>
        </div>

        <div class="top-bar-section">
            <ul class="right">
                <?php
                $loguser = $this->request->session()->read('Auth.User');
                ?>
                <li><?= $this->Html->link(__('Settings'), ['controller' => 'users', 'action' => 'edit', $loguser['id']]) ?></li>
            </ul>
        </div>

        <div class="top-bar-section">
            <ul class="right">

                <li><?= $this->Html->link(__($loguser['name']), 'https://www.google.hu/#q=' . $loguser['name'], ['target' => '_blank']) ?></li>

            </ul>
        </div>
    </nav>


        <!--clockbox with the current time using javascript-->
        <nav class="top-bar expanded" data-topbar role="navigation">
            <ul class="title-area large-3 medium-4 columns">
                <li>
                    <h1 id="clockbox" style="font:8pt Arial; color:white;"><a href=""></a></h1>
                </li>
            </ul>
        </nav>

        <!--javascript to the timing-->
        <script type="text/javascript">
            tday=new Array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
            tmonth=new Array("January","February","March","April","May","June","July","August","September","October","November","December");
            function GetClock(){
                var d=new Date();
                var nday=d.getDay(),nmonth=d.getMonth(),ndate=d.getDate(),nyear=d.getYear();
                if(nyear<1000) nyear+=1900;
                var nhour=d.getHours(),nmin=d.getMinutes(),nsec=d.getSeconds();
                if(nmin<=9) nmin="0"+nmin
                if(nsec<=9) nsec="0"+nsec;
                document.getElementById('clockbox').innerHTML=""+tday[nday]+", "+tmonth[nmonth]+" "+ndate+", "+nyear+" "+nhour+":"+nmin+":"+nsec+"";
            }
            window.onload=function(){
                GetClock();
                setInterval(GetClock,1000);
            }
        </script>

       <!--id to the javascript-->
       <!-- <div id="clockbox"></div> -->

    <!--marquee with the current date-->
    <marquee scrollamount="2" behavior="alternate" bgcolor="black" width="100%">
        <i>
            <font color="#add8e6">
                Today's date is :
                <strong>
                    <span id="time"></span>
                </strong>
            </font>
        </i>
    </marquee>
    <script>
        var today = new Date();
        document.getElementById('time').innerHTML=today.toDateString();
    </script>

    <?= $this->Flash->render() ?>


    <?= $this->Flash->render('auth') ?>



    <div class="container clearfix">
        <?= $this->fetch('content') ?>
    </div>

    <footer>
    </footer>
</body>
</html>
