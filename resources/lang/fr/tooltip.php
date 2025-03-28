<?php

return [
    'product_stock_alert' => "Produits à faible stock. <br/> <small class = 'text-muted'> Basé sur la quantité d'alerte de produit définie dans l'écran d'ajout de produit. <br> Achetez ce produit avant la fin du stock. </small>",
    'payment_dues' => "Paiement en attente pour les achats. <br/> <small class = 'text-muted'> Basé sur la limite de payement du fournisseur. <br/> Affichage des paiements à payer en 7 jours ou moins. </small>",
    'input_tax' => 'Taxe totale collectée pour les ventes dans la période sélectionnée.',
    'output_tax' => 'Taxe totale versée pour les achats pour la période sélectionnée.',
    'tax_overall' => 'Différence entre la taxe totale perçue et la taxe totale payée au cours de la période sélectionnée.',
    'purchase_due' => 'Montant total impayé pour les achats.',
    'sell_due' => 'Montant total à recevoir des ventes',
    'over_all_sell_purchase' => '-ve value = Montant à payer <br> + ve Value = Montant à recevoir',
    'no_of_products_for_trending_products' => 'Nombre de produits de tendance à comparer dans le tableau ci-dessous.',
    'top_trending_products' => "Les produits les plus vendus de votre boutique. <br/> <small class = 'text-muted'> Appliquez des filtres pour connaître les produits tendance pour une catégorie spécifique, une marque, un lieu de travail, etc. </small>",
    'sku' => "Identifiant de produit unique ou unité de gestion des stocks <br> <br> laissez-le vide pour générer automatiquement sku. <br> <small class = 'text-muted'> Vous pouvez modifier le préfixe sku dans les paramètres métier </small> ",
    'enable_stock' => 'Activer ou désactiver la gestion des stocks pour un produit.',
    'alert_quantity' => "Soyez alerté lorsque le stock de produits atteint ou descend en dessous de la quantité spécifiée. <br> <br> <small class = 'text-muted'> Les produits avec un stock faible s'afficheront dans le tableau de bord - Section Alerte stock produit. </small>",
    'product_type' => '<b> Produit unique </b>: Produit sans variations. <br> <b> Produit variable </b>: Produit avec des variations telles que la taille, la couleur, etc.',
    'profit_percent' => "Marge bénéficiaire par défaut pour le produit. <br> <small class ='text-muted'> (<i> Vous pouvez gérer la marge bénéficiaire par défaut dans les paramètres d'entreprise. </small>",
    'pay_term' => "Paiements à payer pour les achats dans la période de temps donnée. <br/> <small class = 'text-muted'> Tous les paiements à venir ou en cours seront affichés dans le tableau de bord - Section Paiement dû </small>",
    'order_status' => 'Les produits de cet achat ne seront disponibles à la vente que si <b> Statut de la commande </b> est <b> Articles reçus </b>.',
    'purchase_location' => "Emplacement de l'entreprise où le produit acheté sera disponible à la vente.",
    'sale_location' => "Emplacement d'affaires d'où vous voulez vendre",
    'sale_discount' => "Définir Remise sur la vente par défaut pour toutes les ventes dans les paramètres d'entreprise.Cliquez sur l'icône d'édition ci-dessous pour ajouter / mettre à jour la réduction.",
    'sale_tax' => "Définir la taxe de vente par défaut' pour toutes les ventes dans les paramètres d'entreprise.Cliquez sur l'icône de modification ci-dessous pour ajouter / mettre à jour la taxe de commande. ",
    'default_profit_percent' => "Marge bénéficiaire par défaut d'un produit. <br> <small class = 'text-muted'> Utilisé pour calculer le prix de vente en fonction du prix d'achat saisi. <br/> Vous pouvez modifier cette valeur pour les produits individuels en ajoutant </small> ",
    'fy_start_month' => "Début du mois de l'année financière pour votre entreprise",
    'business_tax' => 'Numéro de taxe enregistré pour votre entreprise.',
    'invoice_scheme' => "Schéma de facture signifie le format de numérotation des factures.Sélectionnez le schéma à utiliser pour cet emplacement d'entreprise <br> <small class = 'text-muted'> <i> Vous pouvez ajouter un nouveau schéma de facture </b> dans les paramètres de facture </ i > </small> ",
    'invoice_layout' => "Mise en page de facture à utiliser pour cet établissement <br> <small class ='text-muted'> (<i> Vous pouvez ajouter une nouvelle <b> Mise en page de facture </b> dans <b> Paramètres de facture <b> < / i>) </small> ",
    'invoice_scheme_name' => 'Donnez un nom court et significatif au système de facturation.',
    'invoice_scheme_prefix' => 'Préfixe pour un schéma de facture. <br> Un préfixe peut être un texte personnalisé ou une année en cours. Ex: # XXXX0001, # 2018-0002 ',
    'invoice_scheme_start_number' => "Numéro de départ pour la numérotation des factures. <br> <small class = 'text-muted'> Vous pouvez en faire 1 ou tout autre numéro à partir duquel la numérotation commencera. </small>",
    'invoice_scheme_count' => 'Nombre total de factures générées pour le schéma de facture',
    'invoice_scheme_total_digits' => "Longueur du numéro de facture à l'exclusion du préfixe de facture",
    'tax_groups' => "Taux d'imposition de groupe - définis ci-dessus, à utiliser en combinaison dans les sections Achat / Vente.",
    'unit_allow_decimal' => 'Décimales vous permet de vendre les produits connexes en fractions.',
    'print_label' => 'Ajouter des produits -> Choisir les informations à afficher dans les étiquettes -> Sélectionner le réglage du code-barres -> Aperçu des étiquettes -> Imprimer',
    'expense_for' => "Choisissez l'utilisateur pour lequel la dépense est liée à. <I> (Facultatif) </i> <br/> <small> Exemple: Salaire d'un employé. </small>",
    'all_location_permission' => "Si <b> Tous les sites </b> sélectionnés, ce rôle aura la permission d'accéder à tous les lieux d'affaires",
    'dashboard_permission' => "Si non cochée, seul le message d'accueil s'affichera dans la page d'accueil.",
    'access_locations_permission' => "Choisissez tous les emplacements auxquels ce rôle peut accéder.Toutes les données de l'emplacement sélectionné ne seront affichées qu'à l'utilisateur. <br/> <br/> <small> Par exemple: Vous pouvez utiliser ceci pour définir <i> Gérant de magasin / Caissier / Gestionnaire de stock / Gestionnaire de succursale, </i> d'emplacement particulier. </small> ",
    'print_receipt_on_invoice' => "Activer ou désactiver l'impression automatique de la facture lors de la finalisation",
    'receipt_printer_type' => "<i> Impression basée sur le navigateur </i>: Afficher la boîte de dialogue d'impression dans le navigateur avec prévisualisation de la facture <br/> <br/> <i> Utiliser l'imprimante à reçus configurée </i>: sélectionnez une imprimante ticket / thermique configurée pour impression",
    'adjustment_type' => "<I> Normal </i>: Ajustement pour des raisons normales comme des fuites, des dommages, etc. <br/> <br/> <i> Anormal </i>: Ajustement pour des raisons comme le feu, l'accident, etc.",
    'total_amount_recovered' => "Montant récupéré de l'assurance ou de la vente de déchets ou d'autres",
    'express_checkout' => "Marquer l'argent complet et la caisse",
    'total_card_slips' => 'Nombre total de paiements par carte utilisés dans cette caisse',
    'total_cheques' => 'Nombre total de chèques utilisés dans cette caisse',
    'capability_profile' => "La prise en charge des commandes et des pages de codes varient entre les fournisseurs d'imprimantes et les modèles.Si vous n'êtes pas sûr, c'est une bonne idée d'utiliser le profil de capacité' simple.",
    'purchase_different_currency' => 'Sélectionnez cette option si vous achetez dans une devise différente de votre monnaie commerciale',
    'currency_exchange_factor' => "1 Devise d'achat =? Devise de base <br> <small class='text-muted'> Vous pouvez activer / désactiver 'Acheter dans une autre devise' dans les paramètres d'entreprise. </small>",
    'accounting_method' => 'Méthode comptable',
    'transaction_edit_days' => "Nombre de jours à partir de la date de transaction jusqu'à laquelle une transaction peut être modifiée.",
    'stock_expiry_alert' => "Liste des stocks expirant dans :days jours <br> <small class='text-muted'> Vous pouvez définir le nombre de jours dans les paramètres d'entreprise </small>",
];
