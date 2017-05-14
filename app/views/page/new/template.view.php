<?php /** @var View $this */ ?>
<?php /** @var array $templates */ ?>


<h1 style="display: inline-block">Nouvelle page</h1>
<small><a href="<?php echo Helpers::getAdminRoute('page'); ?>">Back</a></small>

<div>
    <?php foreach ($templates as $template): ?>
        <?php $id = isset($template[Page::TEMPLATE_ID]) ? $template[Page::TEMPLATE_ID] : 0; ?>
        <div class="page-template-preview"
             data-id="<?php echo $id ?>">
            <label for="page-template-<?php echo $id; ?>">
                <p class="title">
                    <?php echo isset($template[Page::TEMPLATE_NAME]) ? $template[Page::TEMPLATE_NAME] : ''; ?>
                </p>
                <img src="<?php echo isset($template[Page::TEMPLATE_PREVIEW]) ? $template[Page::TEMPLATE_PREVIEW] : ''; ?>"
                     alt="">
                <input type="radio" name="page-template" id="page-template-<?php echo $id; ?>">
            </label>
        </div>
    <?php endforeach; ?>
</div>

<br>
<a href="" id="next-step"><button>Suivant</button></a>

<script>
    var templates = document.getElementsByClassName('page-template-preview');
    var nextButton = document.querySelector('#next-step');

    for(var i = 0 ; i < templates.length ; i++){
        var template = templates[i];

        template.addEventListener('mousedown', function(){
            var id = this.getAttribute('data-id');

            var src = window.location.href + id;
            nextButton.setAttribute('href', src);
        });
    }

</script>