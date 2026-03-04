<div class="mb-3">
    <input type="text" id="tagSearch" placeholder="Search tags..." class="form-control">
    <small class="text-muted">Checked tags remain visible even when searching</small>
</div>

<div id="tagContainer" class="tag-container">
    @foreach($categories as $tag)
        <div class="tag-item mb-2 mr-2 border py-1 px-2" 
             data-title="{{ strtolower($tag->title) }}"
             data-slug="{{ strtolower($tag->slug) }}"
             data-tag-id="{{ $tag->id }}">
            <label class="catcontainer">
                {{ $tag->title }} ({{ $tag->slug }})
                <input name="tag[]" value="{{ $tag->id }}" type="checkbox" 
                       class="tag-checkbox" onchange="handleCheckboxChange(this)">
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
.tag-item.checked-visible {
    display: inline-block;
}

/* Optional: Different style for checked tags */
.tag-item.checked-visible {
    background-color: #f0f9ff;
    border-color: #007bff !important;
}
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('tagSearch');
    const tagItems = document.querySelectorAll('.tag-item');
    const checkboxes = document.querySelectorAll('.tag-checkbox');
    
    // Track checked tags
    const checkedTags = new Set();
    
    // Initialize - hide all tags
    hideAllTags();
    
    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase().trim();
        
        if (searchTerm === '') {
            hideAllTagsExceptChecked();
        } else {
            searchTags(searchTerm);
        }
    });
    
    // Handle checkbox change
    window.handleCheckboxChange = function(checkbox) {
        const tagItem = checkbox.closest('.tag-item');
        const tagId = tagItem.dataset.tagId;
        
        if (checkbox.checked) {
            checkedTags.add(tagId);
            tagItem.classList.add('checked-visible');
            tagItem.classList.remove('visible'); // Remove search visible if present
        } else {
            checkedTags.delete(tagId);
            tagItem.classList.remove('checked-visible');
            
            // If search is active, re-evaluate visibility
            const searchTerm = searchInput.value.toLowerCase().trim();
            if (searchTerm !== '') {
                const title = tagItem.dataset.title;
                const slug = tagItem.dataset.slug;
                
                if (title.includes(searchTerm) || slug.includes(searchTerm)) {
                    tagItem.classList.add('visible');
                }
            }
        }
    };
    
    // Search function - keeps checked tags visible
    function searchTags(searchTerm) {
        tagItems.forEach(tag => {
            const title = tag.dataset.title;
            const slug = tag.dataset.slug;
            const tagId = tag.dataset.tagId;
            
            // Always show checked tags
            if (checkedTags.has(tagId)) {
                tag.classList.add('checked-visible');
                tag.classList.remove('visible');
                return;
            }
            
            // Check if search term matches
            if (title.includes(searchTerm) || slug.includes(searchTerm)) {
                tag.classList.add('visible');
                tag.classList.remove('checked-visible');
            } else {
                tag.classList.remove('visible');
                tag.classList.remove('checked-visible');
            }
        });
    }
    
    // Hide all tags except checked ones
    function hideAllTagsExceptChecked() {
        tagItems.forEach(tag => {
            const tagId = tag.dataset.tagId;
            
            if (checkedTags.has(tagId)) {
                tag.classList.add('checked-visible');
                tag.classList.remove('visible');
            } else {
                tag.classList.remove('visible');
                tag.classList.remove('checked-visible');
            }
        });
    }
    
    // Hide all tags completely
    function hideAllTags() {
        tagItems.forEach(tag => {
            tag.classList.remove('visible');
            tag.classList.remove('checked-visible');
        });
    }
    
    // Show all tags
    function showAllTags() {
        tagItems.forEach(tag => {
            const tagId = tag.dataset.tagId;
            
            if (checkedTags.has(tagId)) {
                tag.classList.add('checked-visible');
            } else {
                tag.classList.add('visible');
            }
        });
    }
    
    // Optional: Show all tags when search input is focused
    searchInput.addEventListener('focus', function() {
        const searchTerm = this.value.toLowerCase().trim();
        if (searchTerm === '') {
            showAllTags();
        }
    });
    
    // Optional: Hide unselected tags when clicking outside (if search is empty)
    document.addEventListener('click', function(e) {
        if (!searchInput.contains(e.target) && searchInput.value === '') {
            hideAllTagsExceptChecked();
        }
    });
    
    // Initialize already checked checkboxes (if any are pre-checked)
    function initializeCheckedTags() {
        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const tagItem = checkbox.closest('.tag-item');
                const tagId = tagItem.dataset.tagId;
                checkedTags.add(tagId);
                tagItem.classList.add('checked-visible');
            }
        });
    }
    
    initializeCheckedTags();
});

</script>