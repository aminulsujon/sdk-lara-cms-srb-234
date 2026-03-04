<form id="archiveForm" action="archive">
    <div class="row g-3 text-center">

        <div class="col-12 col-md-4 col-lg">
            <div class="">
                <svg width="20" height="20" viewBox="0 0 32 32" fill="#dd3633">
                    <path d="M16 10.667A5.332 5.332 0 0 0 10.668 16a5.332 5.332 0 0 0 5.334 5.333A5.332 5.332 0 0 0 21.334 16a5.332 5.332 0 0 0-5.333-5.333zm11.92 4A11.992 11.992 0 0 0 17.335 4.08V1.333h-2.667V4.08A11.992 11.992 0 0 0 4.081 14.667H1.334v2.666h2.747A11.992 11.992 0 0 0 14.667 27.92v2.747h2.667V27.92a11.992 11.992 0 0 0 10.587-10.587h2.746v-2.666h-2.746zM16 25.333A9.327 9.327 0 0 1 6.668 16a9.327 9.327 0 0 1 9.334-9.333A9.327 9.327 0 0 1 25.334 16a9.327 9.327 0 0 1-9.333 9.333z"/>
                </svg>
                <b class="bn-font d-inline-block mt-1">আর্কাইভ</b>
            </div>
        </div>

        <div class="col-12 col-md-4 col-lg">
            <select name="day" class="form-select bn-font archive" required>
                <option value="">তারিখ</option>
                <option value="01">০১</option>
                <option value="02">০২</option>
                <option value="03">০৩</option>
                <option value="04">০৪</option>
                <option value="05">০৫</option>
                <option value="06">০৬</option>
                <option value="07">০৭</option>
                <option value="08">০৮</option>
                <option value="09">০৯</option>
                <option value="10">১০</option>
                <option value="11">১১</option>
                <option value="12">১২</option>
                <option value="13">১৩</option>
                <option value="14">১৪</option>
                <option value="15">১৫</option>
                <option value="16">১৬</option>
                <option value="17">১৭</option>
                <option value="18">১৮</option>
                <option value="19">১৯</option>
                <option value="20">২০</option>
                <option value="21">২১</option>
                <option value="22">২২</option>
                <option value="23">২৩</option>
                <option value="24">২৪</option>
                <option value="25">২৫</option>
                <option value="26">২৬</option>
                <option value="27">২৭</option>
                <option value="28">২৮</option>
                <option value="29">২৯</option>
                <option value="30">৩০</option>
                <option value="31">৩১</option>
            </select>

        </div>

        <div class="col-12 col-md-4 col-lg">
            <select name="month" class="form-select bn-font archive" required>
                <option value="">মাস</option>
                <option value="01">জানুয়ারি</option>
                <option value="02">ফেব্রুয়ারি</option>
                <option value="03">মার্চ</option>
                <option value="04">এপ্রিল</option>
                <option value="05">মে</option>
                <option value="06">জুন</option>
                <option value="07">জুলাই</option>
                <option value="08">অগাস্ট</option>
                <option value="09">সেপ্টেম্বর</option>
                <option value="10">অক্টোবর</option>
                <option value="11">নভেম্বর</option>
                <option value="12">ডিসেম্বর</option>
            </select>

        </div>

        <div class="col-12 col-md-4 col-lg">
            <select name="year" class="form-select bn-font archive" required>
                <option value="">বছর</option>
                <option value="2026">২০২৬</option>
            </select>
        </div>

        <div class="col-12 col-md-4 col-lg">
            <button type="submit" class="archive_submit bn-font btn">
                অনুসন্ধান
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="7"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </button>
        </div>

    </div>
</form>
