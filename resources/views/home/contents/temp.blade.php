@foreach ($metode as $item)
    @if ($item->active)
        @php
            $admin = $item->total_fee->flat + ($item->total_fee->percent / 100) * $total;
        @endphp
        <div class="col-2">
            <label>
                <input type="radio" name="metode" value="{{ $item->code }}" data-admin-fee="{{ $admin }}"
                    required>
                <img style="width: 70px" src="{{ $item->icon_url }}" alt="{{ $item->name }}">
                <small>admin : {{ number_format($admin, 0, ',', '.') }}</small>
            </label>
        </div>
    @endif
@endforeach


<select name="nomeja" class="form-control col-8">
    @for ($i = 1; $i <= 15; $i++)
        <option value="{{ $i }}">{{ $i }}</option>
    @endfor
</select>
