
<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
  <!-- Meta Tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Laralink">
  <!-- Site Title -->
  <title>{{ $order->magasin->name }} - Facture @if($order->type == 1) d'encaissement @elseif($order->type == 2) de décaissement @endif</title>
  <link class="rounded-circle" rel="apple-touch-icon" sizes="180x180" href="@if(AuthLogedNow()->logo == '') https://ui-avatars.com/api/?name={{AuthLogedNow()->name}} @else {{(Storage::url(AuthLogedNow()->logo))}} @endif">
  <link rel="stylesheet" href="{{ asset('assets/css/invoice.css') }}">
</head>

<body>
  <div class="tm_container">
    <div class="tm_invoice_wrap">
      <div class="tm_invoice tm_style1 tm_type1" id="tm_download_section">
        <div class="tm_invoice_in">
          <div class="tm_invoice_head tm_top_head tm_mb15 tm_align_center">
            <div class="tm_invoice_left">
              <div class="tm_logo"><img style="width:100%;" class="rounded-circle" src="@if ($order->logo != '') {{(Storage::url($order->magasin->logo))}} @else https://ui-avatars.com/api/?name={{$order->magasin->name}} @endif" alt="Logo"></div>
            </div>
            <div class="tm_invoice_right tm_text_right tm_mobile_hide">
              <div class="tm_f50 tm_text_uppercase tm_white_color">Facture @if($order->type == 1) EC @elseif($order->type == 2) DC @endif</div>
            </div>
            <div class="tm_shape_bg tm_accent_bg tm_mobile_hide"></div>
          </div>
          <div class="tm_invoice_info tm_mb25">
            <div class="tm_card_note tm_mobile_hide"><b class="tm_primary_color">Paiement : </b>
              @if ($order->status == 1)
                Total payée
              @elseif ($order->status == 2)
                En cours
              @elseif ($order->status == 3)
                Annulée
              @else
                Non payée
              @endif
            </div>
            <div class="tm_invoice_info_list tm_white_color">
              <p class="tm_invoice_number tm_m0">Numéro No: <b>#{{ str_pad($order->order, 5, '0', STR_PAD_LEFT) }}</b></p>
              <p class="tm_invoice_date tm_m0">Date: <b>{{date('d-m-Y', strtotime( Carbon\Carbon::now() ))}}</b></p>
            </div>
            <div class="tm_invoice_seperator tm_accent_bg"></div>
          </div>
          <div class="tm_invoice_head tm_mb10">
            <div class="tm_invoice_left">
              <p class="tm_mb2"><b class="tm_primary_color">Facturé à:</b></p>
              <p>
                @if ($order->type == 1)
                  @if($order->client_id != '') {{ $order->client->name }} @else {{ $order->name }}@endif <br>
                  @if($order->client_id != '') {{ $order->client->email }} @else {{ $order->email }}@endif <br>
                  @if($order->client_id != '') {{ $order->client->phone }}  @else {{ $order->phone }}@endif
                @else
                  @if($order->client_id != '') {{ $order->client->name_type }} @else {{ $order->name }}@endif <br>
                  @if($order->client_id != '') {{ $order->client->phone_type }}  @else {{ $order->phone }}@endif <br>
                  @if($order->client_id != '') {{ $order->client->rccm }} @else {{ $order->rccm }}@endif <br>
                  @if($order->client_id != '') {{ $order->client->name }} @else {{ $order->name }}@endif <br>
                @endif
                @if($order->client_id != '') {{ $order->client->adresse }} @endif <br>
              </p>
            </div>
            <div class="tm_invoice_right tm_text_right">
              <p class="tm_mb2"><b class="tm_primary_color">Payé à:</b></p>
              <p>
                {{$order->magasin->name}} <br>
                {{$order->magasin->email}} <br>
                {{$order->magasin->phone}}<br>
                {{$order->magasin->adresse}}
              </p>
            </div>
          </div>
          <div class="tm_table tm_style1">
            <div class="">
              <div class="tm_table_responsive">
                <table>
                  <thead>
                    <tr class="tm_accent_bg">
                      <th class="tm_width_4 tm_semi_bold tm_white_color">Désignation</th>
                      <th class="tm_width_3 tm_semi_bold tm_white_color">Couleurs</th>
                      <th class="tm_width_3 tm_semi_bold tm_white_color">Tailles</th>
                      <th class="tm_width_3 tm_semi_bold tm_white_color">Unités</th>
                      <th class="tm_width_3 tm_semi_bold tm_white_color">Quantités</th>
                      <th class="tm_width_2 tm_semi_bold tm_white_color">Prix</th>
                      <th class="tm_width_2 tm_semi_bold tm_white_color tm_text_right">Total</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach(unserialize($order->products) as $product)
                      <tr>
                        <td class="tm_width_4 tm_text_left">{{$product[1]}}</td>
                        <td class="tm_width_3">@if($product[4] != ''){{$product[4]}} @else Null @endif</td>
                        <td class="tm_width_3">@if($product[5] != ''){{$product[5]}} @else Null @endif</td>
                        <td class="tm_width_3">{{$product[7]}}  {{$product[6]}}</td>
                        <td class="tm_width_3 tm_text_center">{{$product[3]}}</td>
                        <td class="tm_width_2">{{$product[2]}}</td>
                        <td class="tm_width_2 tm_text_right">{{$product[2] * $product[3]}}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tm_invoice_footer tm_border_top tm_mb15 tm_m0_md">
              <div class="tm_left_footer">
                <p class="tm_mb2"><b class="tm_primary_color">RCCM:</b> <span class="tm_m0">{{ $order->magasin->registre_com }}</span></p>
                <p class="tm_mb2"><b class="tm_primary_color">NINEA:</b> <span class="tm_m0">{{ $order->magasin->ninea }}</span></p>
              </div>
              <div class="tm_right_footer">
                <table class="tm_mb15">
                  <tbody>
                     @if($order->type == 1)
                      @if($order->client_id != '')
                        <tr class="tm_gray_bg ">
                          <td class="tm_width_3 tm_primary_color tm_bold">Somme décaissée</td>
                          <td class="tm_width_3 tm_primary_color tm_bold tm_text_right">{{$order->client->getAmount()}}</td>
                        </tr>
                        <tr class="tm_gray_bg">
                          <td class="tm_width_3 tm_primary_color tm_bold">Somme restante</td>
                          <td class="tm_width_3 tm_primary_color tm_text_right tm_bold">{{$order->client->getRestant()}}</td>
                        </tr>
                      @endif
                    @elseif ($order->type == 2)
                      @if($order->client_id != '')
                        <tr class="tm_gray_bg ">
                          <td class="tm_width_3 tm_primary_color tm_bold">Somme ecaissée</td>
                          <td class="tm_width_3 tm_primary_color tm_bold tm_text_right">{{$order->client->getAmount()}}</td>
                        </tr>
                        <tr class="tm_gray_bg">
                          <td class="tm_width_3 tm_primary_color tm_bold">Réstant à payer</td>
                          <td class="tm_width_3 tm_primary_color tm_text_right tm_bold">{{$order->client->getRestant()}}</td>
                        </tr>
                      @endif
                    @endif
                    @if ($order->status == 1)
                      <tr class="tm_gray_bg">
                        <td class="tm_width_4 tm_primary_color tm_bold">Méthode :</td>
                        <td class="tm_width_3 tm_primary_color tm_text_right tm_bold">
                          @if ($order->methode == 1)
                          <span class="text-info">Wave</span>
                          @elseif ($order->methode == 2)
                          <span class="text-warning">Orange money</span>
                          @elseif ($order->methode == 3)
                          <span class="text-success">Cache</span>
                          @else
                          Non paye
                          @endif
                        </td>
                      </tr>
                    @endif
                    <tr class="tm_accent_bg">
                      <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color">Grand Total	</td>
                      <td class="tm_width_3 tm_border_top_0 tm_bold tm_f16 tm_white_color tm_text_right">{{ $order->getAmount() }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="tm_invoice_footer tm_type1">
              <div class="tm_left_footer"></div>
              <div class="tm_right_footer">
                <div class="tm_sign tm_text_center">
                  <img src="assets/img/sign.svg" alt="Signature">
                  <p class="tm_m0 tm_ternary_color">{{ $order->magasin->admin_name }}</p>
                  <p class="tm_m0 tm_f16 tm_primary_color">Gestionnaire des comptes</p>
                </div>
              </div>
            </div>
          </div>
          <div class="tm_note tm_text_justify tm_font_style_normal">
            <hr class="tm_mb15">
            <p class="tm_mb2 tm_text_center"><b class="tm_primary_color">Terms & Conditions :</b></p>
            <p class="tm_m0">
              @if ($auth_about != null && $auth_about->our_invoice_info != null)
                {{ $auth_about->our_invoice_info }}
              @else
                L'acheteur renonce à toute réclamation relative à des erreurs de quantité ou d'expédition si elle n'est pas adressée par écrit au vendeur dans les trente (30) jours suivant la livraison des marchandises à l'adresse indiquée.
              @endif
            </p>
          </div><!-- .tm_note -->
        </div>
      </div>
      <div class="tm_invoice_btns tm_hide_print">
        <a href="javascript:window.print()" class="tm_invoice_btn tm_color1">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M384 368h24a40.12 40.12 0 0040-40V168a40.12 40.12 0 00-40-40H104a40.12 40.12 0 00-40 40v160a40.12 40.12 0 0040 40h24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><rect x="128" y="240" width="256" height="208" rx="24.32" ry="24.32" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><path d="M384 128v-24a40.12 40.12 0 00-40-40H168a40.12 40.12 0 00-40 40v24" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="32"/><circle cx="392" cy="184" r="24" fill='currentColor'/></svg>
          </span>
          <span class="tm_btn_text">Imprimer</span>
        </a>
        <button id="tm_download_btn" class="tm_invoice_btn tm_color2">
          <span class="tm_btn_icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path d="M320 336h76c55 0 100-21.21 100-75.6s-53-73.47-96-75.6C391.11 99.74 329 48 256 48c-69 0-113.44 45.79-128 91.2-60 5.7-112 35.88-112 98.4S70 336 136 336h56M192 400.1l64 63.9 64-63.9M256 224v224.03" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/></svg>
          </span>
          <span class="tm_btn_text">Télécharger</span>
        </button>
      </div>
    </div>
  </div>
  <script src="{{ asset('assets/js/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/js/jspdf.min.js') }}"></script>
  <script src="{{ asset('assets/js/html2canvas.min.js') }}"></script>
  <script>
  /* *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** ***
  /////////////////   Down Load Button Function   /////////////////
  *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** *** */
(function ($) {
  'use strict';

  $('#tm_download_btn').on('click', function () {
    var downloadSection = $('#tm_download_section');
    var cWidth = downloadSection.width();
    var cHeight = downloadSection.height();
    var topLeftMargin = 0;
    var pdfWidth = cWidth + topLeftMargin * 2;
    var pdfHeight = pdfWidth * 1.5 + topLeftMargin * 2;
    var canvasImageWidth = cWidth;
    var canvasImageHeight = cHeight;
    var totalPDFPages = Math.ceil(cHeight / pdfHeight) - 1;

    html2canvas(downloadSection[0], { allowTaint: true }).then(function (
      canvas
    ) {
      canvas.getContext('2d');
      var imgData = canvas.toDataURL('image/png', 1.0);
      var pdf = new jsPDF('p', 'pt', [pdfWidth, pdfHeight]);
      pdf.addImage(
        imgData,
        'PNG',
        topLeftMargin,
        topLeftMargin,
        canvasImageWidth,
        canvasImageHeight
      );
      for (var i = 1; i <= totalPDFPages; i++) {
        pdf.addPage(pdfWidth, pdfHeight);
        pdf.addImage(
          imgData,
          'PNG',
          topLeftMargin,
          -(pdfHeight * i) + topLeftMargin * 0,
          canvasImageWidth,
          canvasImageHeight
        );
      }
      pdf.save('download.pdf');
    });
  });

})(jQuery);
  </script>

</body>
</html>