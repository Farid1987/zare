<form action="<?= site_url('admin/editProduct/'.$product->id_product)?>" method="POST">
  <div class="row">
      <div class="col-md-8 col-12">
        <div class="card mb-4">
          <div class="card-header">
            <strong>Product Information</strong>
          </div>
          <div class="card-body">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Nama Product</label>
              <div class="col-sm-9">
                <input class="form-control" type="text" name="nama_product" value="<?= $product->nama_product; ?>" required>
                <span class="help-block text-danger"><?php echo form_error('nama_product'); ?></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Kategori Product</label>
              <div class="col-sm-9">
                <select name="kategori_product" class="form-control" id="kategori_product" required>
                  <?php foreach ($allKategori as $kategori) { ?>
                    <option value="<?= $kategori->id_kategori?>" data-satuan="<?= $kategori->satuan_harga?>"><?= $kategori->nama_kategori?></option>
                  <?php } ?>
                </select>
                <span class="help-block text-danger"><?php echo form_error('kategori_product'); ?></span>
              </div>
            </div>
            
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Short Description</label>
              <div class="col-sm-9">
                <textarea name="short_desc" rows="3" class="form-control" required><?= $product->short_description; ?></textarea>
                <span class="help-block text-danger"><?php echo form_error('short_desc'); ?></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Description</label>
              <div class="col-sm-9">
                <textarea name="desc" id="ckeditor" rows="4" class="form-control" required><?= $product->description; ?></textarea>
                <span class="help-block text-danger"><?php echo form_error('desc'); ?></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Stock</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" name="stock" min="0" required value="<?= $product->stock; ?>">
                <span class="help-block text-danger"><?php echo form_error('stock'); ?></span>
              </div>
            </div>

            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Price</label>
              <div class="col-sm-9">
                <div class="input-group">
                  <div class="input-group-append bg-custom b-0"><span class="input-group-text" style="font-size: 14px">Rp.</span></div>
                  <input type="text" class="form-control currency-format" name="price" required value="<?= $product->price; ?>">
                  <div class="input-group-append bg-custom b-0"><span class="input-group-text" id="harga_satuan" style="font-size: 14px">/ <?= $allKategori[0]->satuan_harga?></span></div>
                </div>
                <span class="help-block text-danger"><?php echo form_error('price'); ?></span>
              </div>
            </div>
          </div>
          <div class="card-footer" id="submit-footer">
            <div class="text-right">
              <a href="<?= site_url('admin/product')?>" class="btn btn-outline-secondary waves-effect">Cancel</a>
              <button type="submit" class="btn btn-outline-dark waves-effect waves-light" id="submit-form">Submit</button>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-header">
            <strong>Featured Image</strong>
          </div>
          <div class="card-body">
            <?php if ($product->featured_img) { ?>
              <div class="img-preview" data-featured="true">
                <span class="img-preview__remove"><i class="ti-close"></i></span>
                <img src="<?= base_url().'/'.$product->featured_img?>" alt="">
                <input type="hidden" value="<?= $product->featured_img?>" name="featured_img_old">
              </div>
            <?php } ?>
            <div class="dropzone mb-1" id="featured_img" <?= ($product->featured_img) ? 'style="display:none"':''?> >
              <div class="fallback">
                <input name="files" type="file" multiple/>
              </div>
            </div>

            <span class="help-block text-danger"><?php echo form_error('featured_img_new'); ?></span>
          </div>
        </div>
        <div class="card mb-4">
          <div class="card-header">
            <strong>Gallery</strong>
          </div>
          <div class="card-body">
            <?php if (count($productGallery) > 0) { ?>
              <div class="row mb-3">
                <?php for ($i=0; $i < count($productGallery); $i++) { ?>
                  <div class="col-sm-6">
                    <div class="img-preview">
                      <span class="img-preview__remove"><i class="ti-close"></i></span>
                      <img data-id="<?= $productGallery[$i]->id_product_images?>" src="<?= base_url().'/'.$productGallery[$i]->url?>" alt="">
                    </div>
                  </div>
                <?php } ?>
              </div>
            <?php } ?>

            <div class="dropzone" id="gallery">
              <div class="fallback">
                <input name="files" type="file" multiple/>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </form>
    
<script type="text/javascript">
$(document).ready(function() {
  $(window).keydown(function(event){
    if(event.keyCode == 13) {
      event.preventDefault();
      return false;
    }
  });

  //ckeditor
  let desc = CKEDITOR.replace('ckeditor', {
    toolbarGroups: [
      { name: 'styles', groups: [ 'styles' ] },
    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
    { name: 'links', groups: [ 'links' ] },
    { name: 'insert', groups: [ 'insert' ] },
  ],
  removeButtons: 'RemoveFormat,Subscript,Superscript,Strike,CreateDiv,JustifyLeft,JustifyCenter,JustifyRight,JustifyBlock,BidiLtr,BidiRtl,Language,Anchor,Flash,Table,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,Styles,Format,Font,TextColor,BGColor,Maximize,ShowBlocks,About'
  });

  desc.on( 'required', function( evt ) {
    alert( 'Description is required.' );
    evt.cancel();
  } );

  // currency
  $(document).on('keyup', '.currency-format', function() {
    let amount = $(this).val().replace(/\D/g,'');
    $(this).val(accounting.formatMoney(amount, "", 0, "."));
  });

  // handle change kategori product
  $('#kategori_product').on('change', function() {
    let satuan = $(this).find('option:selected').data('satuan');
    $('#harga_satuan').text('/ '+satuan);
  })
  if (<?= isset($product->id_kategori)?>) {
    $('#kategori_product').val('<?= $product->id_kategori?>');
    $('#kategori_product').trigger('change');
  } else if ('<?= set_value('kategori_product')?>' != '') {
    $('#kategori_product').val('<?= set_value('kategori_product')?>');
    $('#kategori_product').trigger('change');
  }

  // delete
  $('.img-preview__remove').on('click', function(e) {
    e.preventDefault();

    if (window.confirm('Are you sore want yo delete this image ?')) {
      let $parent = $(this).parents('.img-preview');
      if (!$parent.data('featured')) {
        let $form = $(this).parents('form');
        let input = document.createElement('input');
        input.name = 'deletedGallery[]';
        input.value = $parent.find('img').data('id');
        input.type = 'hidden';

        $form.append(input);
      } else {
        $('#featured_img').show();
      }

      $parent.remove();
    }
  })
  Dropzone.autoDiscover = false;

  let featuredImg = new Dropzone("#featured_img", { 
    url: "<?= site_url('admin/uploadImg')?>",
    acceptedFiles: 'image/jpeg, image/png, image/webp, image/gif',
    addRemoveLinks: true,
    uploadMultiple: true,
    maxFiles: 1,
    maxFilesize: 1,
    thumbnailWidth: null,
    thumbnailHeight: null,
    paramName: 'files',
    dictDefaultMessage: 'Upload one featured image',
    success: successDz,
    removedfile: removeFileDz,
    sendingmultiple: disabledSubmit,
    completemultiple: enabledSubmit,
    canceledmultiple: enabledSubmit,
  });

  let galleryDropzone = new Dropzone("#gallery", { 
    url: "<?= site_url('admin/uploadImg')?>",
    acceptedFiles: 'image/jpeg, image/png, image/webp, image/gif',
    addRemoveLinks: true,
    uploadMultiple: true,
    thumbnailWidth: 100,
    thumbnailHeight: 100,
    maxFilesize: 1,
    paramName: 'files',
    successmultiple: successDz,
    removedfile: removeFileDz,
    sendingmultiple: disabledSubmit,
    completemultiple: enabledSubmit,
    canceledmultiple: enabledSubmit,
  });

  function successDz(files, res) {
    res = $.parseJSON(res);
    let length = res.img.length;
    if (Array.isArray(files)) {
      files.forEach(file => {
        for (let i = 0; i < length; i++) {
          if (file.name == res.img[i].name && file.size == res.img[i].size) {
            file.previewElement.dataset.url = res.img[i].link;
          }
        }
      });
    } else {
      let previewElement = files.previewElement;
      previewElement.dataset.url = res.img[0].link;
    }
  }

  function removeFileDz(file) {
    let url = "<?= site_url('admin/removeImg')?>";
    let imgLink = file.previewElement.dataset.url;

    if (file.status != 'error') {
      $.ajax({
        url,
        type: 'POST',
        data: {imgLink},
        // success: function(res) {
        //   console.log(res);
        // },
        // error: function(err) {
        //   console.log(err);
        // }
      })
    }
    
    let _ref;
    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
  }

  function disabledSubmit() {
    $('#submit-footer').addClass('disabled');
  }
  function enabledSubmit() {
    $('#submit-footer').removeClass('disabled');
  }

  $('#submit-form').on('click', function(e) {
    e.preventDefault();
    
    let $featured = $('#featured_img').find('.dz-preview');
    let $form = $(this).parents('form');
    let inputFeatured = document.createElement('input');

    if ($form.find('input[name=featured_img]').length <= 0) {
      inputFeatured.setAttribute('name', 'featured_img_new');
      inputFeatured.setAttribute('hidden', true);
      inputFeatured.value = ($featured.data('url')) ? $featured.data('url'):'';
      
      $form.append(inputFeatured);
    }

    let $gallery = $('#gallery').find('.dz-preview');
    if ($gallery.length > 0) {
      let lengthGallery = $gallery.length
      for (let i = 0; i < lengthGallery; i++) {
        if ($gallery[i].dataset.url) {
          let inputGallery = document.createElement('input');
          inputGallery.setAttribute('name', 'gallery[]');
          inputGallery.setAttribute('hidden', true);
          inputGallery.value = $gallery[i].dataset.url;
          $form.append(inputGallery);
        }
      }
    }
    
    if ($form[0].reportValidity()) {
      $form.submit();
    }
  })
})
</script>