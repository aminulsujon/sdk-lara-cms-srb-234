<div class="mb-2">
  <label for="seq" class="">Lead Sequence</label>
  <input name="seq" id="seq" type="number" value="{{ $content->seq ?? '' }}" class="border-b form-control w-full btn-primary">
</div> 
<div class="mb-2">
  <label for="seqc" class="">Category Seqcuence</label>
  <input name="seqc" id="seqc" type="number" value="{{ $content->seqc ?? 1 }}" class="border-b form-control w-full btn-primary">
</div> 