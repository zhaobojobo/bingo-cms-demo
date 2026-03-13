$( document ).ready(function() {
  $(document).on('dblclick','.editable',function() {

      editdata = $(this).data('text');
      column = $(this).data('column');
      pageid = $(this).data('pageid');

      html  ='<div class="input-group editdiv">';
      html +='<input type="text" name="'+column+'" value="'+editdata+'" class="edit_input"/>';
      html +='<input type="hidden" name="page_id" value="'+pageid+'"/>';
      html +='<button title="保存" class="button-gray bingo_button icon_button"><i class="fa fa-save"></i></button></div>';
      $(this).html(html);
  });
});