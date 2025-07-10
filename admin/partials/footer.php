</main>
    </div>

    <footer style="text-align:center; padding: 10px 0; font-size: 14px; color: #666;">
        Developed by Quantixa Labs
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/trumbowyg.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Trumbowyg/2.27.3/plugins/colors/trumbowyg.colors.min.js"></script>
    <script>
        $('.editor').trumbowyg({
            btnsDef: {
                image: {
                    dropdown: ['insertImage', 'upload'],
                    ico: 'insertImage'
                }
            },
            btns: [
                ['viewHTML'],
                ['undo', 'redo'],
                ['formatting'],
                'btnGrp-semantic',
                ['link'],
                ['image'],
                'btnGrp-lists',
                ['foreColor', 'backColor'],
                ['horizontalRule'],
                ['fullscreen']
            ]
        });
    </script>
</body>
</html>