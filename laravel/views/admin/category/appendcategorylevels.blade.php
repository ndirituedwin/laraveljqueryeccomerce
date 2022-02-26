
<div class="form-grop{{$errors->has('parent')?' has-error text-danger':''}}">
    <label for="parent" class="control-label">Select category level</label>
    <select class="form-control select2" name="parent"  id="parent" style="width: 100%;">
      <option value="0" @if (isset($categoriesedit['parent_id']) && $categoriesedit['parent_id']==0)
          selected
      @endif>Main category</option>
     @if (!empty($getcategories))
     @foreach ($getcategories as $category)
         <option value="{{$category['id']}}" 
         AD
         @if (isset($categoriesedit['parent_id']) && $categoriesedit['parent_id']==$category['id'])
          selected
      @endif
         >{{$category['categoryname']}}</option>

         @if (!empty($category['subcategories']))
         @foreach ($category['subcategories'] as $subcategory)
    <option value="{{$subcategory['id']}}" style="background-color: red">&nbsp;&raquo;{{$subcategory['categoryname']}}</option>
         @endforeach
 
         @endif
     @endforeach
         
     @endif
    </select>
       @if ($errors->has('parent'))
    <span class="help-block text-danger">{{$errors->first('parent')}}</span>
@endif
</div>