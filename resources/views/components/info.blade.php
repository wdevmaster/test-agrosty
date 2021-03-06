<div class="card-deck mb-3 text-center">
    <div class="card border-info mb-3 shadow-sm">
        <div class="card-body">
            <h1 class="card-title pricing-card-title">
                {{ $mails->count() }}
            </h1>
            <h3 class="text-info">Email Enviados</h3>
        </div>
    </div>
    <div class="card border-success mb-3 shadow-sm">
        <div class="card-body">
            <h1 class="card-title pricing-card-title">
                {{ $analyzes->where('pts', '<', 2.5)->count() }}
            </h1>
            <h3 class="text-success">Email Validos</h3>
        </div>
    </div>
    <div class="card border-danger mb-3 shadow-sm">
        <div class="card-body">
            <h1 class="card-title pricing-card-title">
                {{ $analyzes->where('pts', '>=', 2.5)->count() }}
            </h1>
            <h3 class="text-danger">Email Spam</h3>
        </div>
    </div>
    <div class="card border-warning mb-3 shadow-sm">
        <div class="card-body">
            <h1 class="card-title pricing-card-title">
                {{ $analyzes->sum('num_spam_words') }}
                <small>/ {{ $analyzes->sum('num_words') }} </small>
            </h1>
            <h3 class="text-warning">Uso de palabras spam</h3>
        </div>
    </div>
</div>