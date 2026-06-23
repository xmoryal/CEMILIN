<div class="offcanvas offcanvas-end" id="cartCanvas">
    <div class="offcanvas-header">
        <h5 id="cartCanvasLabel">Keranjang</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">

      <form action="">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle">

                    @foreach ($keranjang as $cart)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="checkDefault">
                                </div>
                            </td>
                            <td>
                                <img src="{{ asset('assets/img/produk/' . $cart->foto) }}" width="50"
                                    height="50">
                            </td>
                            <td>
                                <table>
                                    <tr>
                                        <th>{{ $cart->nama_produk }}</th>
                                    </tr>
                                    <tr>
                                        <td>Rp. {{ number_format($cart->harga) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Banyak : {{ $cart->banyak }}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    @endforeach

                </table>
            </div>
        </div>

        <div class="mt-2">
            <div class="d-flex justify-content-between">
                <div class="small text-muted">Total</div>
                <div class="price">Rp. {{ number_format($total) }}</div>
            </div>
            <div class="mt-3">
                <button class="btn btn-success w-100">Checkout</button>
            </div>
        </div>
    </form>
</div>