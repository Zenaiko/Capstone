// Update the character counter
function updateCounter(inputId, counterId, maxLength) {
    const input = document.getElementById(inputId);
    const counter = document.getElementById(counterId);
    counter.innerText = `${input.value.length}/${maxLength}`;
}

// Preview multiple images and add remove functionality
function previewImages(event) {
    const files = event.target.files;
    const container = document.getElementById('image-preview-container');
    container.innerHTML = ''; 
    if (files) {
        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const imgWrapper = document.createElement('div');
                imgWrapper.className = 'image-preview-wrapper';

                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'image-preview';

                const removeBtn = document.createElement('button');
                removeBtn.className = 'remove-image-btn';
                removeBtn.textContent = '×';
                removeBtn.onclick = function() {
                    imgWrapper.remove();
                };

                imgWrapper.appendChild(img);
                imgWrapper.appendChild(removeBtn);
                container.appendChild(imgWrapper);
            }
            reader.readAsDataURL(file);
        });
    }
}

const category_shown = document.getElementById('category_shown');

$('.radio_ary').on('click', function() {
    category_shown.innerHTML = this.value;
});

    const add_variant_btn_canvas = document.getElementById('add_variant_btn_canvas');
    const added_variant_contents = document.getElementById('added_variant_contents');
    const add_variant_field = document.getElementById('add_variant_field');
    const vairant_title = document.getElementById('vairant_title');
    const stock = document.getElementById('stock');
    const price = document.getElementById('price');

    // Off canvas form
    const variant_form_type = document.getElementById('variant_form_type');
    const variant_form_price = document.getElementById('variant_form_price');
    const variant_form_stock = document.getElementById('variant_form_stock');
    const add_variant_type_img = document.getElementById('add_variant_type_img');
    const variant_img = document.getElementById('variant_img');
    const add_variant_type = document.getElementById('add_variant_type');
    let img_showcase;
    let img_files;
    let reader = new FileReader();



    let totalStock = 0;
    let minPrice = Infinity;
    let maxPrice = -Infinity;

    function var_img(event){
        img_files = event.target.files;
        Array.from(img_files).forEach(file => {
            reader.onload = function(e) {  
                img_showcase = e.target.result
                variant_img.src = img_showcase;
            };
                reader.readAsDataURL(file);
            });
    
        };

 

    add_variant_type.addEventListener('click', function(event) {
        event.preventDefault(); 
        
        const addedVariantDiv = document.createElement('div');
        addedVariantDiv.className = 'added_variant';
        addedVariantDiv.setAttribute('id', variant_form_type.value + 'div');
        
        const varContents = document.createElement('div');
        varContents.className = 'var_contents';

        const var_img = document.createElement('img');
        var_img.alt = variant_form_type.value;
        var_img.src = img_showcase;
        var_img.className = 'var_img';

        const addedVarInfo = document.createElement('div');
        addedVarInfo.className = 'added_var_info';

        const variant_name = document.createElement('input');
        variant_name.type = 'text';
        variant_name.readOnly = true;
        variant_name.name = 'variant_name[' + variant_form_type.value + ']';
        variant_name.placeholder = variant_form_type.value;
        variant_name.value = variant_form_type.value;

        const added_var_img =  document.createElement('input');
        added_var_img.type = 'file';
        added_var_img.name = 'variant_name['+variant_form_type.value+'][img]';
       

        const variant_price = parseFloat(variant_form_price.value) || 0; // Ensure this is a number
        const variant_stock = parseInt(variant_form_stock.value) || 0; // Ensure this is a number

        // Update min and max prices
        if (variant_price < minPrice) {
            minPrice = variant_price;
        }
        if (variant_price > maxPrice) {
            maxPrice = variant_price;
        }

        const price_input = document.createElement('input');
        price_input.type = 'text';
        price_input.readOnly = true;
        price_input.name = 'variant_name['+variant_form_type.value+'][price]';
        price_input.placeholder = variant_price;
        price_input.value = variant_price;

        const stock_input = document.createElement('input');
        stock_input.type = 'text';
        stock_input.readOnly = true;
        stock_input.name = 'variant_name['+variant_form_type.value+'][stock]';
        stock_input.placeholder = variant_form_stock.value;
        stock_input.value = variant_stock;

        addedVarInfo.appendChild(variant_name);
        addedVarInfo.appendChild(price_input);
        addedVarInfo.appendChild(stock_input);
        addedVarInfo.appendChild(added_var_img);

        varContents.appendChild(var_img);
        varContents.appendChild(addedVarInfo);

        addedVariantDiv.appendChild(varContents);
        added_variant_contents.appendChild(addedVariantDiv);

        totalStock += variant_stock;
        stock.readOnly = true;
        stock.value = totalStock;
        price.readOnly = true;
        if (minPrice === maxPrice){
            price.value = minPrice
        }else{
            price.value = `${minPrice} - ${maxPrice}`; // Update to show min-max range
        }
    });
