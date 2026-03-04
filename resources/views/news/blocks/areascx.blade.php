<form action="search" class="mb-4 bg-light p-3 rounded" id="searchFormInner" method="POST">
    @csrf
    <div class="form-row">
        <div class="col-4">
            <svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" fill="none"><path d="M16 10.667A5.332 5.332 0 0 0 10.668 16a5.332 5.332 0 0 0 5.334 5.333A5.332 5.332 0 0 0 21.334 16a5.332 5.332 0 0 0-5.333-5.333zm11.92 4A11.992 11.992 0 0 0 17.335 4.08V1.333h-2.667V4.08A11.992 11.992 0 0 0 4.081 14.667H1.334v2.666h2.747A11.992 11.992 0 0 0 14.667 27.92v2.747h2.667V27.92a11.992 11.992 0 0 0 10.587-10.587h2.746v-2.666h-2.746zM16 25.333A9.327 9.327 0 0 1 6.668 16a9.327 9.327 0 0 1 9.334-9.333A9.327 9.327 0 0 1 25.334 16a9.327 9.327 0 0 1-9.333 9.333z" fill="#dd3633"></path></svg>
            <span class="txt-cx">আমার এলাকার খবর </span>
        </div>
        <div class="col">
            <span>জেলা: কক্সবাজার</span>
        </div>
        <div class="col">
            @csrf
            <select class="form-control" name="q">
                <option value="">-- উপজেলা --</option>
                <option value="চকরিয়া">চকরিয়া</option>
                <option value="কক্সবাজার সদর">কক্সবাজার সদর</option>
                <option value="কুতুবদিয়া">কুতুবদিয়া</option>
                <option value="মহেশখালী">মহেশখালী</option>
                <option value="পেকুয়া">পেকুয়া</option>
                <option value="রামু">রামু</option>
                <option value="সীতাকুণ্ড">সীতাকুণ্ড</option>
            </select>
        </div>
        <div class="col">
            <button type="submit" class="btn btn-sm btn-primary px-5">
                অনুসন্ধান করুন
            </button>
        </div>
    </div>
</form>