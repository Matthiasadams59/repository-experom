<?php
ob_start();
?>
<section id="contact">
    <h1>Nous contacter</h1>
    <div class="contact">
        <ul>
            <li><div>Localisation :</div><em>10 rue de Vanve</em> </li>
            <li><div>numéro de telephone: </div><em>###########</em>  </li>
            <li><div>E-mail : </div><em><a href="mailto: domisep@free.fr" class="email"> domisep@free.fr</a></em></li>
        </ul>
    </div>
</section>
<?php
$section = ob_get_clean();