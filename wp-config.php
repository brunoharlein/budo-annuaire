<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'martial');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'root');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'U)S$4LF-zh =j%BnCb+OWRc`~eA.NXXqZ:DZ.kpe@B<wkBtK*+876Mb,>!Ri^ESp');
define('SECURE_AUTH_KEY',  'Sgp_|Z)FGTan0hT7%Tf2NZbB6&$.cVdJ.ca%jy=rTc%ST1]zuJT]v2+|H+Qp`+jB');
define('LOGGED_IN_KEY',    'C@vJm=?@y~M%XKs1aYY~74t8cQ{ue}FGAzvBeNAfevMY|DCc; 7))6}qH0C.v}]{');
define('NONCE_KEY',        '{?W0(qezSV-55yKCZu-|k`!Z[TS?p{gv^s;F%&sG/06Bv>iW$#<E@f;y;Uk@rC^F');
define('AUTH_SALT',        '}5qG<uZWKCxV}NoAGjn?Py9Gv|>*Oovc:wZpfK#vPg`a%r$P,}Iqv}]:oa2@+jh ');
define('SECURE_AUTH_SALT', '`-.FmWo7P{Q]`-Xl?4e}L-80~@EE;<=^HlhgO3,<`+(kQe3xWkM;a)!ZSs%cO%Vl');
define('LOGGED_IN_SALT',   't)VG1.~97lw`joO..7~1Uz`IF$}{uRFBF?,3CVa?z3>6mkV&-je-.c/Vx;9FFGvy');
define('NONCE_SALT',       'JQXLgb+W)eF2Qf6=--NB2,& aSeI34j< o_q.~H$^HQDZ/oUB .%yK:V/LronOY2');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');