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
define( 'AUTH_KEY',         '-&D#|T#R4Om/+|Ulc8S4dJ8%Dw>X1_-,IG3&7tK6W;z+l|Z)5Y3l7}5}(H8Qj;Cy' );
define( 'SECURE_AUTH_KEY',  'd]7o*m?z9{hT8~N`p5;d+O<Y}{.C|6<1+g*Dyil9WEdQ(kie=FcLpYuecDW+7y_T' );
define( 'LOGGED_IN_KEY',    '<ZZh(ZN$n2&XX[<V{,)-!)M2pAL1go94`*Ox_DoIio03(DUvn9,~CIA5^Mdt{<Aj' );
define( 'NONCE_KEY',        'nm7~`JFb,%>A/3n;ZC+vju&M~q*rn@ CqKg=r;}@S0=%ugzs0V9ch^S2Hc7&k%e&' );
define( 'AUTH_SALT',        'hIeA{/9&wb$1Aiob:JOO0zHK7= aFb:;faH^-WU$0~ch:?IuF %Ydb|l)9,c~d_+' );
define( 'SECURE_AUTH_SALT', 'Ka$=C.CiB*%^hcHAkuOkVJiQ$oa--u;*6uzsC&Pn[]TCl~G;04x:wS,^*8>Nc fL' );
define( 'LOGGED_IN_SALT',   '.P~|o-yZXnyG5NObg~@-JX=Y*Qx14/{`_y)ST;j,5N,BIrx_XPU,MgP(+}w@W;$!' );
define( 'NONCE_SALT',       'dr@7rgmq3}ue%?%/Z]V$J$J=:PfX@7<{1u6s-`*lJ,t7p8.GKSa,`UswJ|0F0;=g' );

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
