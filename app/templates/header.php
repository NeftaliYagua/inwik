<header class='masthead'>
    <div id="bgtransparent"></div>
    <div id="notifications-panel"><div id="notifications-panel-wrapper"></div><div id="notifications-actions"></div></div>
    <div id="notifications-wrapper"></div>
    <div id="logo">
        <a href="<?=PAGE_DOMAIN?>"><img src="app/templates/img/layout/logo-header.svg"/></a>
    </div>
    <nav id="top-menu">
        <ul>
            <li id="tab-prop"><a href="proposals"><?=__("Propuestas")?></a></li>
            <li id="tab-proj"><a href="proyectos"><?=__("Proyectos")?></a></li>
            <li id="tab-event"><a href="eventos"><?=__("Eventos")?></a></li>
        </ul>
    </nav>
    <nav id="right-actions">
        <?php include DIR.'/app/views/header/usermenu.php';?>
    </nav>
</header>
