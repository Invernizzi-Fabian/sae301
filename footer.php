<footer class="footer">
    <!-- Logo au centre -->
    <div class="footer-logo">
        <img src="<?php echo get_template_directory_uri(); ?>/images/LOGO-COMPLET-BLANC.png" alt="Logo NexusBattles" />
    </div>

    <!-- Liens de la politique de confidentialité, mentions légales, et conditions générales -->
    <nav class="footer-nav">
        <ul>
            <li><a href="<?php echo get_permalink(get_page_by_title('Politique de Confidentialité')->ID); ?>" class="footer-link">Politique de Confidentialité</a></li>
            <li><a href="<?php echo get_permalink(get_page_by_title('Mentions Legales')->ID); ?>" class="footer-link">Mentions Légales</a></li>
            <li><a href="<?php echo get_permalink(get_page_by_title('Conditions Générales d\'Utilisation')->ID); ?>" class="footer-link">Conditions Générales d'Utilisation</a></li>
        </ul>
    </nav>

    <!-- Lien Nous contacter et texte © -->
    <div class="footer-contact">
        <a href="<?php echo get_permalink(get_page_by_title('nous-contacter')->ID); ?>" class="footer-link">Nous contacter</a>
        <p>@ 2024 NexusBattles. Tous droits réservés.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
