<option value="">-- Select Subcategory --</option>
@foreach ($subcategories as $subcategory)
    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
@endforeach