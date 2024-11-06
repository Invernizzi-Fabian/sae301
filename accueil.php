<?php
/*
Template Name: Page d'accueil
*/

get_header(); // Inclut l'en-tête du site
?>

<div class="home-container">
    <h1 class="home-title">Bienvenue sur Nexus Battles</h1>
    <p class="home-description">La Plateforme Ultime pour vos Tournois Esport de League of Legends !</p>

    <h2>COMMENT PARTICIPER ?</h2>
    <p>Il vous suffit de trouver 5 coéquipiers et de créer une équipe sur le site ! Consultez ensuite les matchs qui sont prévus.</p>

    <h2>COMMENT LE TOURNOI SE DEROULE ?</h2>
    <p>Après la création, un match vous sera attribué à une heure précise qu'il vous suffira de rejoindre en temps voulu pour jouer la partie.</p>
    <p>Après la première partie, un autre match sera prévu contre une autre équipe à une autre date définie, et ainsi de suite jusqu'à ce que toutes les équipes se soient affrontées entre elles.</p>
    <p>Si vous gagnez la partie, vous gagnez 1 point ; si vous perdez, vous perdez également 1 point. L’équipe avec le plus de points remporte le tournoi.</p>
    
    <img src="<?php echo get_template_directory_uri(); ?>/images/garen.png" alt="League of Legends" class="images" />

    <p>Ici, les équipes s'affrontent dans des compétitions intenses, suivant un format de tournoi structuré pour garantir un suivi rigoureux des performances.</p>

    <div class="home-conclusion">
        <a class='bouton' href="<?php echo site_url('/equipes'); ?>">VOIR LES EQUIPES</a>
    </div>
</div>

<?php
get_footer(); // Inclut le pied de page du site
?>
