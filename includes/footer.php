</main>
        <footer>
            <div class="social-links">
                <a href="#" target="_blank"><?php echo $lang_pack['footer_github']; ?></a>
                <a href="#" target="_blank"><?php echo $lang_pack['footer_linkedin']; ?></a>
                <a href="#" target="_blank"><?php echo $lang_pack['footer_twitter']; ?></a>
            </div>
            <p>&copy; <?php echo date("Y"); ?> | MD Nazir Hossain. <?php echo $lang_pack['footer_copyright']; ?></p>
            <p>Developed by Quantixa Labs</p>
        </footer>

        <a href="#" id="back-to-top" title="<?php echo $lang_pack['back_to_top_title']; ?>">&uarr;</a>

    </div>
    <script src="assets/js/script.js"></script>
</body>
</html>
<?php
// End and flush output buffer
ob_end_flush();
?>