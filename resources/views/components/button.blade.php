<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm']) }}>
    {{ $slot }}
</button>
