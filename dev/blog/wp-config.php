<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/pt-br:Editando_wp-config.php
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'emotors_dev--blog' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'emotors_admin' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', 'Emotors12345' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'tfA}-lG7]XPG^Y*nn}7xvdAU[~%}W5v&oO3N}^j1E;w^T j$}LFlSpC?,Go4n!mT' );
define( 'SECURE_AUTH_KEY',  'D0?Z-(Kz7pn+&dBP=~C<WWCG1ZNY22+M=P <Xtx._f-452JfnR_/V7R!LXZ>*;t$' );
define( 'LOGGED_IN_KEY',    'WGHQvmRh2@)?IvC@3&@!(x#0>y3MKH3C9/gz.D+|;GG Y*#x~:,%hB11(1$3[X4;' );
define( 'NONCE_KEY',        'O$1x.<twUi&vpSvV1h>WH(W4Db7;K;w~)}hD#`oJ:+d$A_m~UR>/V/vVXYQU{v{f' );
define( 'AUTH_SALT',        'Yv}NXIzUsog`}a8b)KQK|l)R[J*%3pD~2EvwB-*OmNkFp>8Fl6dJP<U+]z=5!-YH' );
define( 'SECURE_AUTH_SALT', 'nQvWqJesb6aZ~_M.IT3Ra;qyscA!:rklk[e/m~%,`;FmF.-;~FQhyJd*Y5y8 [O;' );
define( 'LOGGED_IN_SALT',   '4`2ZW3$xm(P9hj6U^Vwp6TUd3;,pfGd/Gh4_r3My0Kc0>DDJEfaM(*E>,{:aL?@~' );
define( 'NONCE_SALT',       'yC<l7;S1sSHHjBje/LMu1hg><VrV|~` sP}C+x= bR#HN<RT^doUE67<xhidn(^N' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'em_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://codex.wordpress.org/pt-br:Depura%C3%A7%C3%A3o_no_WordPress
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Configura as variáveis e arquivos do WordPress. */
require_once(ABSPATH . 'wp-settings.php');
