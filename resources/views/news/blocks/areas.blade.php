<meta name="csrf-token" content="{{ csrf_token() }}">
<form action="areas" id="searchFormInner" method="POST">
    @csrf
    <div class="form-row">

        @if(!empty($head))
        <div class="col-6 col-md-4 col-lg">
            <svg width="20" height="20" viewBox="0 0 32 32" fill="#dd3633">
                <path d="M16 10.667A5.332 5.332 0 0 0 10.668 16a5.332 5.332 0 0 0 5.334 5.333A5.332 5.332 0 0 0 21.334 16a5.332 5.332 0 0 0-5.333-5.333zm11.92 4A11.992 11.992 0 0 0 17.335 4.08V1.333h-2.667V4.08A11.992 11.992 0 0 0 4.081 14.667H1.334v2.666h2.747A11.992 11.992 0 0 0 14.667 27.92v2.747h2.667V27.92a11.992 11.992 0 0 0 10.587-10.587h2.746v-2.666h-2.746zM16 25.333A9.327 9.327 0 0 1 6.668 16a9.327 9.327 0 0 1 9.334-9.333A9.327 9.327 0 0 1 25.334 16a9.327 9.327 0 0 1-9.333 9.333z"/>
            </svg>
            <span class="txt-cx">আমার এলাকার খবর</span>
        </div>
        @endif

        <div class="col-6 col-md-4 col-lg">
            <select class="form-control" id="division" name="division">
                <option value="">-- বিভাগ --</option>
                @if(!empty($divisions))
                    @foreach($divisions as $division)
                        <option value="{{ $division->id }}">{{ $division->title }}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col-6 col-md-4 col-lg">
            <select class="form-control" id="district" name="district" disabled>
                <option value="">-- জেলা --</option>
            </select>
        </div>

        <div class="col-6 col-md-4 col-lg">
            <select class="form-control" id="upazila" name="upazila" disabled>
                <option value="">-- উপজেলা --</option>
            </select>
        </div>

        <div class="col-6 col-md-4 col-lg">
            <button type="submit" class="btn btn-sm btn-primary px-5">
                অনুসন্ধান
            </button>
        </div>
    </div>
</form>

<div id="loading" style="display:none;">
    <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
    <span>লোড হচ্ছে...</span>
</div>

<script>
    
document.addEventListener("DOMContentLoaded", function () {

    const divisionSelect = document.getElementById("division");
    const districtSelect = document.getElementById("district");
    const upazilaSelect  = document.getElementById("upazila");
    const loading        = document.getElementById("loading");

    // ❗ Stop script if ANY element is missing
    if (!divisionSelect || !districtSelect || !upazilaSelect) {
        console.log("Does not exist in DOM!");
        return;
    }

    function resetSelect(select, text) {
        select.innerHTML = `<option value="">${text}</option>`;
        select.disabled = true;
    }

    function populateSelect(select, data) {
        select.disabled = false;
        data.forEach(item => {
            let opt = document.createElement("option");
            opt.value = item.id;
            opt.textContent = item.title;
            select.appendChild(opt);
        });
    }

    function showLoading() { loading.style.display = "block"; }
    function hideLoading() { loading.style.display = "none"; }

    // Load districts
    divisionSelect.addEventListener("change", function () {
        const divisionId = this.value;
        resetSelect(districtSelect, "-- জেলা --");
        resetSelect(upazilaSelect, "-- উপজেলা --");

        if (!divisionId) return;

        showLoading();

        fetch(`/get-districts/${divisionId}`)
            .then(res => res.json())
            .then(data => {
                populateSelect(districtSelect, data);
                hideLoading();
            })
            .catch(() => {
                alert("জেলা লোড করতে সমস্যা হয়েছে");
                hideLoading();
            });
    });

    // Load upazilas
    districtSelect.addEventListener("change", function () {
        const districtId = this.value;
        resetSelect(upazilaSelect, "-- উপজেলা --");

        if (!districtId) return;

        showLoading();

        fetch(`/get-upazilas/${districtId}`)
            .then(res => res.json())
            .then(data => {
                populateSelect(upazilaSelect, data);
                hideLoading();
            })
            .catch(() => {
                alert("উপজেলা লোড করতে সমস্যা হয়েছে");
                hideLoading();
            });
    });

});
</script>

