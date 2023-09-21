<select name="nomeja" class="form-control col-8">
    @for ($i = 1; $i <= 15; $i++)
        <option value="{{ $i }}">{{ $i }}</option>
    @endfor
</select>
