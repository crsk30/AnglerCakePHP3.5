<h1>Add Product</h1>

<?= $this->Form->create($product, ['type' => 'file']) ?>
<fieldset>
    <legend><?= __('Add Product') ?></legend>

    <?= $this->Form->control('category_id', ['label' => 'Category', 'options' => $categories, 'empty' => 'Select Category', 'id' => 'category-id']) ?>
    <?= $this->Form->control('subcategory_id', ['label' => 'Subcategory', 'empty' => 'Select Subcategory', 'id' => 'subcategory-id']) ?>
    <?= $this->Form->control('subsubcategory_id', ['label' => 'Subsubcategory', 'empty' => 'Select Subsubcategory', 'id' => 'subsubcategory-id']) ?>
    <?= $this->Form->control('product_name', ['label' => 'Product Name']) ?>
    <?= $this->Form->control('product_code', ['label' => 'Product Code']) ?>
    <?= $this->Form->control('product_price', ['label' => 'Product Price']) ?>
    <?= $this->Form->control('product_quantity', ['label' => 'Product Quantity']) ?>
    <?= $this->Form->control('product_image', ['type' => 'file', 'label' => 'Product Image']) ?>
</fieldset>

<?= $this->Form->button(__('Save Product')) ?>
<?= $this->Form->end() ?>
<?= $this->Html->script('jquery-3.7.1.min.js') ?>

<script>
// AJAX for loading subcategories and subsubcategories dynamically
$('#category-id').change(function() {
    var categoryId = $(this).val();
    $categoryId = categoryId;
    $.ajax({
        url: '<?= $this->Url->build(['controller' => 'Products', 'action' => 'getSubcategories']) ?>/' + categoryId,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#subcategory-id').html('');
            $.each(response.subcategories, function(key, value) {
                $('#subcategory-id').append('<option value="' + key + '">' + value + '</option>');
            });
            console.log("Result :",response)
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown);
            console.error('Response:', jqXHR.responseText);
        }
    });
});


$('#subcategory-id').change(function() {
    var subcategoryId = $(this).val();
    $.ajax({
        url: '<?= $this->Url->build(['controller' => 'Products', 'action' => 'getSubsubcategories']) ?>/' + subcategoryId,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            $('#subsubcategory-id').html(''); // Clear previous sub-subcategories
            if (response.subsubcategories) {
                $.each(response.subsubcategories, function(key, value) {
                    $('#subsubcategory-id').append('<option value="' + key + '">' + value + '</option>');
                });
            } else {
                console.log('No sub-subcategories found for this subcategory.');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown);
            console.error('Response:', jqXHR.responseText);
            alert('Failed to load sub-subcategories. Please try again.');
        }
    });
});

</script>
