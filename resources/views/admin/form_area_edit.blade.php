{{-- Tag Search Section for Edit Blade --}}
<div class="mb-3">
    <input type="text" id="areaSearch" placeholder="Search tags..." class="form-control">
    <small class="text-muted">Checked tags remain visible even when searching</small>
</div>

<div id="areaContainer" class="tag-container">
    @foreach($categories as $tag)
        @php
            // Get old values if form was submitted with errors
            $oldTags = old('tag', []);
            
            // Get existing tags from content (for edit mode)
            $existingTags = isset($content) ? $content->tags->pluck('id')->toArray() : [];
            
            // Determine if checkbox should be checked
            $isChecked = in_array($tag->id, $oldTags) || in_array($tag->id, $existingTags);
            
            // Add a data attribute for initial checked state
            $initiallyChecked = $isChecked ? 'data-initially-checked="true"' : '';
        @endphp
        
        <div class="tag-item mb-2 mr-2 border py-1 px-2" 
             data-title="{{ strtolower($tag->title) }}"
             data-slug="{{ strtolower($tag->slug) }}"
             data-tag-id="{{ $tag->id }}"
             {{ $initiallyChecked }}>
            <label class="catcontainer">
                {{ $tag->title }} ({{ $tag->slug }})
                <input name="tag[]" 
                       value="{{ $tag->id }}" 
                       type="checkbox" 
                       class="tag-checkbox"
                       {{ $isChecked ? 'checked' : '' }}>
                <span class="checkmark"></span>
            </label>
        </div>
    @endforeach
</div>

<style>
    .tag-item {
        display: none;
        transition: all 0.3s ease;
    }

    .tag-item.visible,
    .tag-item.checked-visible,
    .tag-item.initially-checked {
        display: inline-block;
    }

    /* Different styles for different states */
    .tag-item.checked-visible {
        background-color: #e3f2fd;
        border-color: #2196f3 !important;
        border-width: 2px;
    }
    
    .tag-item.initially-checked {
        background-color: #f0f9ff;
        border-color: #007bff !important;
    }
    
    .tag-item.visible:not(.checked-visible):not(.initially-checked) {
        background-color: #f8f9fa;
    }

    /* Checkbox styling */
    .catcontainer {
        display: block;
        position: relative;
        padding-left: 30px;
        margin-bottom: 0;
        cursor: pointer;
        font-size: 14px;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .catcontainer input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #f8f9fa;
        border: 2px solid #dee2e6;
        border-radius: 4px;
        transition: all 0.2s ease;
    }

    .catcontainer:hover input ~ .checkmark {
        background-color: #e9ecef;
        border-color: #adb5bd;
    }

    .catcontainer input:checked ~ .checkmark {
        background-color: #007bff;
        border-color: #007bff;
    }

    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    .catcontainer input:checked ~ .checkmark:after {
        display: block;
    }

    .catcontainer .checkmark:after {
        left: 6px;
        top: 2px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('areaSearch');
    const tagItems = document.querySelectorAll('.tag-item');
    const checkboxes = document.querySelectorAll('.tag-checkbox');
    
    // Track checked tags (both initially checked and user-checked)
    const checkedTags = new Set();
    const initiallyCheckedTags = new Set();
    
    // Initialize
    initializeCheckedTags();
    
    // Show initially checked tags
    showInitiallyCheckedTags();
    
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase().trim();
        
        if (searchTerm === '') {
            showInitiallyCheckedTags();
        } else {
            searchTags(searchTerm);
        }
    });
    
    // Handle checkbox change
    function handleCheckboxChange(checkbox) {
        const tagItem = checkbox.closest('.tag-item');
        const tagId = tagItem.dataset.tagId;
        
        if (checkbox.checked) {
            checkedTags.add(tagId);
            tagItem.classList.add('checked-visible');
            tagItem.classList.remove('visible', 'initially-checked');
        } else {
            checkedTags.delete(tagId);
            tagItem.classList.remove('checked-visible');
            
            // Check if it was initially checked
            if (initiallyCheckedTags.has(tagId)) {
                tagItem.classList.add('initially-checked');
            } else {
                tagItem.classList.remove('initially-checked');
                
                // If search is active, re-evaluate visibility
                const searchTerm = searchInput.value.toLowerCase().trim();
                if (searchTerm !== '') {
                    const title = tagItem.dataset.title;
                    const slug = tagItem.dataset.slug;
                    
                    if (title.includes(searchTerm) || slug.includes(searchTerm)) {
                        tagItem.classList.add('visible');
                    } else {
                        tagItem.classList.remove('visible');
                    }
                }
            }
        }
    }
    
    // Search function
    function searchTags(searchTerm) {
        tagItems.forEach(tag => {
            const tagId = tag.dataset.tagId;
            const title = tag.dataset.title;
            const slug = tag.dataset.slug;
            
            // Always show checked tags
            if (checkedTags.has(tagId)) {
                tag.classList.add('checked-visible');
                tag.classList.remove('visible', 'initially-checked');
                return;
            }
            
            // Show initially checked tags even during search
            if (initiallyCheckedTags.has(tagId)) {
                tag.classList.add('initially-checked');
                tag.classList.remove('visible', 'checked-visible');
                return;
            }
            
            // Check if search term matches
            if (title.includes(searchTerm) || slug.includes(searchTerm)) {
                tag.classList.add('visible');
                tag.classList.remove('initially-checked', 'checked-visible');
            } else {
                tag.classList.remove('visible', 'initially-checked', 'checked-visible');
            }
        });
    }
    
    // Show initially checked tags (from old() or existing content)
    function showInitiallyCheckedTags() {
        tagItems.forEach(tag => {
            const tagId = tag.dataset.tagId;
            
            if (initiallyCheckedTags.has(tagId)) {
                tag.classList.add('initially-checked');
                tag.classList.remove('visible', 'checked-visible');
            } else {
                tag.classList.remove('initially-checked', 'visible', 'checked-visible');
            }
        });
    }
    
    // Show all tags
    function showAllTags() {
        tagItems.forEach(tag => {
            const tagId = tag.dataset.tagId;
            
            if (checkedTags.has(tagId)) {
                tag.classList.add('checked-visible');
                tag.classList.remove('initially-checked', 'visible');
            } else if (initiallyCheckedTags.has(tagId)) {
                tag.classList.add('initially-checked');
                tag.classList.remove('checked-visible', 'visible');
            } else {
                tag.classList.add('visible');
                tag.classList.remove('initially-checked', 'checked-visible');
            }
        });
    }
    
    // Initialize checked tags
    function initializeCheckedTags() {
        checkboxes.forEach(checkbox => {
            const tagItem = checkbox.closest('.tag-item');
            const tagId = tagItem.dataset.tagId;
            
            // Check if initially checked (from data attribute)
            if (tagItem.hasAttribute('data-initially-checked')) {
                initiallyCheckedTags.add(tagId);
            }
            
            // If checkbox is currently checked, add to checkedTags
            if (checkbox.checked) {
                checkedTags.add(tagId);
            }
            
            // Add event listener
            checkbox.addEventListener('change', function() {
                handleCheckboxChange(this);
            });
        });
    }
    
    // Optional: Show all tags when search input is focused
    searchInput.addEventListener('focus', function() {
        const searchTerm = this.value.toLowerCase().trim();
        if (searchTerm === '') {
            showAllTags();
        }
    });
    
    // Optional: Add buttons for better UX
    addControlButtons();
    
    function addControlButtons() {
        // Create button container
        const buttonContainer = document.createElement('div');
        buttonContainer.className = 'd-flex gap-2 mt-2';
        
        // Show All button
        const showAllBtn = document.createElement('button');
        showAllBtn.type = 'button';
        showAllBtn.className = 'btn btn-sm btn-outline-primary';
        showAllBtn.textContent = 'Show All';
        showAllBtn.addEventListener('click', showAllTags);
        
        // Show Checked Only button
        const showCheckedBtn = document.createElement('button');
        showCheckedBtn.type = 'button';
        showCheckedBtn.className = 'btn btn-sm btn-outline-success';
        showCheckedBtn.textContent = 'Show Checked';
        showCheckedBtn.addEventListener('click', function() {
            tagItems.forEach(tag => {
                const tagId = tag.dataset.tagId;
                
                if (checkedTags.has(tagId) || initiallyCheckedTags.has(tagId)) {
                    if (checkedTags.has(tagId)) {
                        tag.classList.add('checked-visible');
                    } else {
                        tag.classList.add('initially-checked');
                    }
                    tag.classList.remove('visible');
                } else {
                    tag.classList.remove('visible', 'initially-checked', 'checked-visible');
                }
            });
            searchInput.value = '';
        });
        
        // Reset button (show initially checked only)
        const resetBtn = document.createElement('button');
        resetBtn.type = 'button';
        resetBtn.className = 'btn btn-sm btn-outline-secondary';
        resetBtn.textContent = 'Reset';
        resetBtn.addEventListener('click', function() {
            showInitiallyCheckedTags();
            searchInput.value = '';
        });
        
        // Add buttons to container
        buttonContainer.appendChild(showAllBtn);
        buttonContainer.appendChild(showCheckedBtn);
        buttonContainer.appendChild(resetBtn);
        
        // Insert after search input
        searchInput.parentNode.appendChild(buttonContainer);
    }
    
    // Optional: Add counter for selected tags
    addSelectedCounter();
    
    function addSelectedCounter() {
        const counter = document.createElement('div');
        counter.className = 'mt-2 text-muted';
        counter.id = 'selectedCounter';
        
        updateCounter();
        
        // Insert after tag container
        areaContainer.parentNode.appendChild(counter);
        
        // Update counter on checkbox change
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateCounter);
        });
        
        function updateCounter() {
            const totalChecked = document.querySelectorAll('.tag-checkbox:checked').length;
            counter.textContent = `${totalChecked} tag${totalChecked !== 1 ? 's' : ''} selected`;
        }
    }
    
    // Optional: Clear search on Escape key
    searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            this.value = '';
            showInitiallyCheckedTags();
        }
    });
});
</script>