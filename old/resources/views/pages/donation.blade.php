@extends('layouts.layout')

@section('content')

<section class="main">
    <div data-bg="files/wp-content/themes/Marassil/images/bg-header-inner.png" class="bg-img header-bg rocket-lazyload entered lazyloaded"></div>
    <section class="wrapper wowo fadeInUp animated">

        <div class="breadcrumbs-page container">
            <div class="breadcrumbs">
                <div class="breadcrumbs-box">
                    <span>Vous êtes ici :</span>
                    <a href="https://www.unitedmarassil.org">Accueil</a>
                    <span>Faire un don</span>
                </div>
            </div>
        </div>

        <section class="page-title not-h2">
            <div class="page-title-box inner">
                <div class="title">
                    <h1 class="wowo animated">Faire un don</h1>
                </div>
            </div>
        </section>


        <h3 class="wp-block-heading" id="">Votre don nous aide à être là pour tous ceux qui ont besoin de nous,merci pour votre soutien.</h3>

        <p id="">Votre contribution changera la vie d’un enfant dans le besoin. Votre soutien donnera à un enfant une belle vie de famille et un avenir meilleur.</p><br>
        <p id="">Détails de l'identité bancaire :<br>
    
        Nom de l'association : ASSOCIA UNITED MARASSIL ASSOCIATION<br>
        Banque : Banque Populaire de B.P Marrakech-Beni Mellal<br>
        Numéro de compte : 2121161812930006<br>

        SWIFT : BCPOMAMC<br>

        Détails de l'adresse : N°3 ANG. BD AL KHATTABI ET BD.<br><br>

        Ces informations peuvent être utilisées pour les virements bancaires ou l'enregistrement des transactions avec l'association.
        </p>



        <section class="wp-block-title-c">
            <h2>Formulaire de Don</h2>
        </section>

        <h3 class="wp-block-heading" id="">Changez la vie d'un enfant grâce à vos dons.</h3>


        <section class="formulaire-de-contact">
            <div class="formulaire-de-contact-box inner wowo fadeInUp">
                <div class="wpcf7 js" id="wpcf7-f10741-o1" lang="fr-FR" dir="ltr">
                    <div class="screen-reader-response">
                        <p role="status" aria-live="polite" aria-atomic="true"></p>
                        <ul></ul>
                    </div>


                    @if (session('success'))
                        <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 5px; font-size: 18px; margin-bottom: 20px;">
                            <strong>Succès : </strong> {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; font-size: 18px; margin-bottom: 20px;">
                            <strong>Erreur : </strong> {{ session('error') }}
                        </div>
                    @endif



                    <form action="{{ route('donations.donate') }}" method="post" class="wpcf7-form init" >
                    @csrf
                        <div class="content">
                            <!-- Prénom -->
                            <div class="form-group width-33">
                                <p><span class="wpcf7-form-control-wrap" data-name="first_name">
                                        <input required size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" value="" type="text" name="first_name"></span>
                                </p>
                                <div class="text-l">
                                    <p>Prénom <i>*</i></p>
                                </div>
                            </div>
                            <!-- Nom -->
                            <div class="form-group width-33">
                                <p><span class="wpcf7-form-control-wrap" data-name="last_name">
                                        <input required size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" value="" type="text" name="last_name"></span>
                                </p>
                                <div class="text-l">
                                    <p>Nom <i>*</i></p>
                                </div>
                            </div>
                            <!-- Email -->
                            <div class="form-group width-33">
                                <p><span class="wpcf7-form-control-wrap" data-name="email">
                                        <input required size="40" class="wpcf7-form-control wpcf7-email wpcf7-validates-as-required" aria-required="true" aria-invalid="false" value="" type="email" name="email"></span>
                                </p>
                                <div class="text-l">
                                    <p>Email <i>*</i></p>
                                </div>
                            </div>
                            <!-- Téléphone -->
                            <div class="form-group width-50">
                                <p><span class="wpcf7-form-control-wrap" data-name="phone">
                                        <input required size="40" class="wpcf7-form-control wpcf7-tel wpcf7-validates-as-tel" aria-invalid="false" value="" type="tel" name="phone"></span>
                                </p>
                                <div class="text-l">
                                    <p>Téléphone</p>
                                </div>
                            </div>
                            <!-- Méthode de Paiement -->
                            <div class="form-group width-50">
                                <p><span class="wpcf7-form-control-wrap" data-name="payment_method">
                                        <select class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" name="payment_method" aria-required="true">
                                            <option value="0" selected >Méthode de Paiement</option>    
                                            <option  value="card">Carte Bancaire</option>
                                            <option value="transfer">Virement Bancaire</option>
                                            <option value="cheque">Chèque</option>
                                        </select></span>
                                </p>
                            </div>
                            <!-- Montant du Don -->
                            <div class="form-group width-50" id="amount-group" style="display:none;">
                                <p><span class="wpcf7-form-control-wrap" data-name="amount">
                                        <input  size="40" class="wpcf7-form-control wpcf7-number wpcf7-validates-as-required" aria-required="true" aria-invalid="false" value="" type="number" name="amount"></span>
                                </p>
                                <div class="text-l">
                                    <p>Montant du Don <i>*</i></p>
                                </div>
                            </div>
                            <!-- Currency -->
                            <div class="form-group width-50" id="currency-group" style="display:none;">
                                <p><span class="wpcf7-form-control-wrap" data-name="currency">
                                        <select class="wpcf7-form-control wpcf7-select wpcf7-validates-as-required" name="currency" aria-required="true">
                                            <option>Choisir Devise</option>    
                                            <option value="MAD">MAD</option>
                                            <option value="EUR">EUR</option>
                                        </select></span>
                                </p>
                            </div>

                            <!-- Pays -->
                            <div class="form-group width-50">
                                <p><span class="wpcf7-form-control-wrap" data-name="country">
                                        <input required size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" value="" type="text" name="country"></span>
                                </p>
                                <div class="text-l">
                                    <p>Pays <i>*</i></p>
                                </div>
                            </div>

                            <!-- Ville -->
                            <div class="form-group width-50">
                                <p><span class="wpcf7-form-control-wrap" data-name="city">
                                        <input required size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" value="" type="text" name="city"></span>
                                </p>
                                <div class="text-l">
                                    <p>Ville <i>*</i></p>
                                </div>
                            </div>
                            <!-- Address -->
                            <div class="form-group width-100">
                                <p><span class="wpcf7-form-control-wrap" data-name="address">
                                        <input required size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false" value="" type="text" name="address"></span>
                                </p>
                                <div class="text-l">
                                    <p>Adresse <i>*</i></p>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="form-submit">
                                <div class="box">
                                    <input class="wpcf7-form-control wpcf7-submit has-spinner" type="submit" value="Envoyer" />
                                </div>
                            </div>
                        </div>
                        <div class="wpcf7-response-output" aria-hidden="true"></div>
                    </form>

                </div>
            </div>
        </section>



        <div class="go-top">
            <a href="#"></a>
        </div>
    </section>
</section>

<script>
   document.addEventListener("DOMContentLoaded", function () {
        const paymentMethodSelect = document.querySelector('select[name="payment_method"]');
        const amountGroup = document.getElementById('amount-group');
        const currencyGroup = document.getElementById('currency-group');

        paymentMethodSelect.addEventListener('change', function () {
            if (this.value === 'card') {
                amountGroup.style.display = 'block';
                currencyGroup.style.display = 'block';
            } else {
                amountGroup.style.display = 'none';
                currencyGroup.style.display = 'none';
            }
        });
    });

</script>

@endsection
