<div class="bars bars-with-sidebar-left cf">

  <aside class="sidebar">
    <div class="sidebar-content section">
      <h2 class="hgroup hgroup-single-line hgroup-compressed cf">
        <span class="hgroup-title">
          <a href="">Blueprints</a>
        </span>
      </h2>
      <ul class="nav nav-list sidebar-list">
        <?php foreach($blueprints as $blueprint): ?>
          <li><a class="load-file" href="" data-target="blueprints/<?= $blueprint ?>"><i class="icon icon-left fa fa-file-o"></i><span><?=  $blueprint ?></span></a></li>
        <?php endforeach ?>
      </ul>

      <h2 class="hgroup hgroup-single-line hgroup-compressed cf">
       <span class="hgroup-title">
         <a href="">Templates</a>
       </span>
      </h2>
      <ul class="nav nav-list sidebar-list">
        <?php foreach($templates as $template): ?>
          <li><a class="load-file" href="" data-target="templates/<?= $template ?>"><i class="icon icon-left fa fa-file-o"></i><span><?=  $template ?></span></a></li>
        <?php endforeach ?>
      </ul>

      <h2 class="hgroup hgroup-single-line hgroup-compressed cf">
        <span class="hgroup-title">
          <a href="">Snippets</a>
        </span>
      </h2>
      <ul class="nav nav-list sidebar-list">
        <?php foreach($snippets as $snippet): ?>
          <li><a class="load-file" href="" data-target="snippets/<?= $snippet ?>"><i class="icon icon-left fa fa-file-o"></i><span><?=  $snippet ?></span></a></li>
        <?php endforeach ?>
      </ul>
    </div>
  </aside>

  <div class="mainbar">
    <div class="section">
      <h2 class="hgroup cf"><span>Editor</span></h2>

      <form method="post" action="" class="form" data-keep="">
        <fieldset class="fieldset field-grid cf">
          <div class="field field-grid-item field-name-text field-with-textarea field-with-buttons">
            <label class="label label-filename" for="form-field-text"></label>
            <div class="field-content">
          </div>
          </div>
          <input type="hidden" name="csrf" value=""><input type="hidden" name="_redirect">
        </fieldset>
        <button class="btn btn-rounded save-blueprint">Save</button>
      </form>
    </div>
  </div>

</div>
<?= css(url() . '/site/plugins/code-editor/assets/css/styles.css') ?>

<?= js(url() . '/site/plugins/code-editor/assets/js/codemirror.js') ?>
<?= css(url() . '/site/plugins/code-editor/assets/css/codemirror.css') ?>
<?= js(url() . '/site/plugins/code-editor/assets/js/xml.js') ?>
<?= js(url() . '/site/plugins/code-editor/assets/js/javascript.js') ?>
<?= js(url() . '/site/plugins/code-editor/assets/js/css.js') ?>
<?= js(url() . '/site/plugins/code-editor/assets/js/htmlmixed.js') ?>
<?= js(url() . '/site/plugins/code-editor/assets/js/clike.js') ?>

<?= js(url() . '/site/plugins/code-editor/assets/js/yaml.js') ?>
<?= js(url() . '/site/plugins/code-editor/assets/js/php.js') ?>
<script>
//$(document).ready(function(){
  $('h2').click(function() {
    $(this).next('ul').slideToggle();
  });
//});

  var myCodeMirror = CodeMirror(function(elt) {
    $('.field-content').append(elt);
  },
    {
      lineNumbers: true,
      mode: "php",
      matchBrackets: true
    }
  );

  $('.load-file').on('click', function() {
    console.log('click');
    $('.label-filename').html('');
    $('.load-file.active').removeClass('active');
    //e.preventDefault();
    $(this).addClass('active');
    var url = $(this).data('target');
    console.log(url);
    $.fn.getFilecontents(url);
  });

  $('.save-blueprint').on('click', function() {
    var data = JSON.stringify($('textarea').val());
    var huhu = JSON.stringify(myCodeMirror.getValue());
    console.log(huhu);
    var filename = $('.load-file.active').data('target');
    console.log(filename);
    $.fn.saveContents(filename, huhu);
  });


  $.fn.getFilecontents = function(url) {
    var baseURL = window.location.href;
    $.ajax({
      url: baseURL + '/' + url,
      type: 'GET',

      success: function(response) {
        console.log(response);
        myCodeMirror.setValue(response);
        $('.label-filename').append(url);
      }
    });
  };

  $.fn.saveContents = function(filename, data) {
    console.log('filename: ' + filename);
    console.log(data);
    var baseURL = window.location.href;
    var send = {cont: data};
    $.ajax({
      url: baseURL + '/save/' + filename,
      type: 'POST',
      data: send,
      dataType: 'json',
      success: function(response) {
        location.reload();

      }
    });
  };
</script>
