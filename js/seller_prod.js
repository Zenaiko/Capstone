
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


$('.radio_ary').on('click', function(){
    category_shown.innerHTML = this.value;
})

document.addEventListener('DOMContentLoaded', () => {
    var add_varaint_btn_canvas = document.getElementById('add_varaint_btn_canvas');
    const added_variant_contents = document.getElementById('added_variant_contents');
    const add_variant_field = document.getElementById('add_variant_field');
    const vairant_title = document.getElementById('vairant_title');

    // Get variant info form
    const variant_form_type = document.getElementById('variant_form_type');
    const variant_form_price = document.getElementById('variant_form_price');
    const variant_form_stock = document.getElementById('variant_form_stock');
    const add_variant_type_img = document.getElementById('add_variant_type_img');
    const add_variant_type = document.getElementById('add_variant_type');

    // add_varaint_btn_canvas.addEventListener('click' , () =>{
        // event.preventDefault(); 

        // const addedVariantDiv = document.createElement('div');
        // addedVariantDiv.className = 'added_varaint';
        // addedVariantDiv.setAttribute('id', add_variant_field.value + 'div');
    
        // // Create the inner div with class 'var_header'
        // const varHeaderDiv = document.createElement('div');
        // varHeaderDiv.className = 'var_header';
        // varHeaderDiv.id = add_variant_field.value ;
    
        // // Create the input element
        // const inputElement = document.createElement('input');
        // inputElement.type = 'text';
        // inputElement.readOnly = true;
        // inputElement.className = 'var_name';
        // inputElement.value = add_variant_field.value;
        // inputElement.setAttribute('id', add_variant_field.value);
        // inputElement.name =  'variant_name[' + add_variant_field.value + ']';
    
        // // Create the div for buttons
        // const varButtonsDiv = document.createElement('div');
        // varButtonsDiv.className = 'var_buttons';
    
        // // Create the 'Edit' button
        // const editButton = document.createElement('button');
        // editButton.className = 'var_button ';
        // editButton.textContent = 'Edit';
        // editButton.type = 'button';
        // editButton.setAttribute('data-bs-toggle', 'offcanvas');
        // // Set the 'data-bs-target' attribute
        // editButton.setAttribute('data-bs-target', '#variant_form');
        // // Set the 'aria-controls' attribute
        // editButton.setAttribute('aria-controls', 'offcanvasBottom');
        // editButton.setAttribute('id', add_variant_field.value);

    
        // // Create the 'Add' button
        // const addButton = document.createElement('button');
        // addButton.className = 'var_button add_button';
        // addButton.textContent = 'Add';
        // addButton.type = 'button';
        // addButton.setAttribute('data-bs-toggle', 'offcanvas');
        // // Set the 'data-bs-target' attribute
        // addButton.setAttribute('data-bs-target', '#variant_form');
        // // Set the 'aria-controls' attribute
        // addButton.setAttribute('aria-controls', 'offcanvasBottom');
        // addButton.setAttribute('id', add_variant_field.value);
    
        // // Append the input and buttons to their respective containers
        // varButtonsDiv.appendChild(editButton);
        // varButtonsDiv.appendChild(addButton);
        // varHeaderDiv.appendChild(inputElement);
        // varHeaderDiv.appendChild(varButtonsDiv);
    
        // // Append the header to the outer div
        // addedVariantDiv.appendChild(varHeaderDiv);
        // added_variant_contents.appendChild(addedVariantDiv);
        
     
// $('.add_button').on('click' , function(){
//     const add_id = $(this).attr('id');
//     vairant_title.innerHTML = add_id;
//     div_variant  = document.getElementById(add_id + "div");
//     controller_var = add_id; 
    
//     })

// })

add_variant_type.addEventListener('click' , function(){

    event.preventDefault(); 

    const addedVariantDiv = document.createElement('div');
    addedVariantDiv.className = 'added_varaint';
    addedVariantDiv.setAttribute('id', variant_form_type.value + 'div');
    // Create the main container div
    const varContents = document.createElement('div');
    varContents.className = 'var_contents';
 
    // Create the image element
    const img = document.createElement('img');
    img.src = '../assets/tmp.png';
    img.alt = '';
    img.className = 'var_img';
 
    // Create the div for additional information
    const addedVarInfo = document.createElement('div');
    addedVarInfo.className = 'added_var_info';
 
    // Create the name input element
    const variant_name = document.createElement('input');
    variant_name.type = 'text';
    variant_name.readOnly = true;
    variant_name.name = 'variant_name[' + variant_form_type.value + ']';
    variant_name.placeholder = variant_form_type.value;
    variant_name.value = variant_form_type.value;
 
    // Create the second input element
    const variant_price = document.createElement('input');
    variant_price.type = 'text';
    variant_price.readOnly = true;
    variant_price.name = 'variant_name[' + variant_form_type.value + '][price]';
    variant_price.placeholder = variant_form_price.value;
    variant_price.value = variant_form_price.value;
 
    // Create the third input element
    const variant_stock = document.createElement('input');
    variant_stock.type = 'text';
    variant_stock.readOnly = true;
    variant_stock.name = 'variant_name[' + variant_form_type.value + '][stock]';
    variant_stock.placeholder = variant_form_stock.value;
    variant_stock.value = variant_form_stock.value;
 
    // Append input elements to the addedVarInfo div
    addedVarInfo.appendChild(variant_name);
    addedVarInfo.appendChild(variant_price);
    addedVarInfo.appendChild(variant_stock);
 
    // Append the image and addedVarInfo div to the varContents div
    varContents.appendChild(img);
    varContents.appendChild(addedVarInfo);
             
    addedVariantDiv.appendChild(varContents);
            added_variant_contents.appendChild(addedVariantDiv);

 
     })

})

