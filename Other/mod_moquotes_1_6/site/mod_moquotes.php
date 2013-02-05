<?php
/**
 * @file
 * @version = 1.07
 * @package MoQuotes
 * @copyright (C) 2008 Mo Kelly
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * MoQuotes is free software. This version may have been modified pursuant
 * to the GNU General Public License, and as distributed it includes or
 * is derivative of works licensed under the GNU General Public License or
 * other free or open source software licenses.
 * See COPYRIGHT.php for copyright notices and details.
 *
 */
defined('_JEXEC') or die('Restricted access');

/* Security Note: These values are auto-sanitized by mosGetParam() */
$quote_params['moduleclass_sfx'] 		= $params->get( 'moduleclass_sfx' );
$quote_params['quote_style'] 				= $params->get( 'quote_style', 'quote' );
$quote_params['source_rss'] 				= $params->get( 'source_rss', 'rss' ); /* db or txt or RSS*/

/* Create functions. */
if(!defined('MOQUOTES_LOADED')){
	define('MOQUOTES_LOADED', 1);


	function MoQuotesDisplay($quote_params, $q=''){
		if('' == $q){
			$q = 'Before God we are all equally wise - and equally foolish. - Albert Einstein ';
		}
		echo $q;
	}	    
   
	function MoQuotesProcessRSS($quote_params){
      
		$q = '';
		Switch  ($quote_params['source_rss'])
		{
			Case 1:
				$q = '<script language="javascript" src="http://www.dontquoteme.com/feeds/js/qotd-180x150.js"></script>';
				break;
			Case 2:
				$q = '<script language="javascript" src="http://www.allgreatquotes.com/scripts/quotefunny.js"></script>' ;
				break;
			Case 3:
				$q = '<script language="javascript" src="http://www.allgreatquotes.com/scripts/quoteday.js"></script>' ;
				break;
			Case 4:
				$q= '<SCRIPT TYPE="text/javascript" SRC="http://www.quotesandpoem.com/quotes/quoteoftheday.js"></SCRIPT>'  ;
				break;
			Case 5:
				$q = '<script language="JavaScript" src="http://www.surfnetkids.com/applets/chuckle.js"></script>';
				break;
			Case 6:
				$q = '<SCRIPT TYPE="text/javascript" SRC="http://www.quotationspage.com/data/1qotd.js"></script>';
				break;                                    
			Case 7:
				$q = '<script language="javascript" src="http://www.quotedb.com/quote/quote.php?action=random_quote&=&=&"></script>' ;
				break;
			Case 8:
				$q = '<script language="javascript" src="http://www.quotedb.com/quote/quote.php?action=quote_of_the_day"></script>';
				break;
			Case 9:
				$q = '<SCRIPT TYPE="text/javascript" SRC="http://www.brainyquote.com/link/quotebr.js"></SCRIPT>' ;
				break;
			Case 10:
				$q = '<SCRIPT TYPE="text/javascript" SRC="http://www.brainyquote.com/link/quotelo.js"></SCRIPT>' ;
				break;
			Case 11:
				$q = '<SCRIPT TYPE="text/javascript" SRC="http://www.brainyquote.com/link/quotefu.js"></SCRIPT>';
				break;
			Case 12:
				$q = '<SCRIPT TYPE="text/javascript" SRC="http://www.brainyquote.com/link/quotear.js"></SCRIPT>' ;
				break;
			Case 13:
				$q = '<SCRIPT TYPE="text/javascript" SRC="http://www.brainyquote.com/link/quotena.js"></SCRIPT>' ;
				break;
			Case 14:	
				$q = '<SCRIPT TYPE="text/javascript" SRC="http://www.thepisstakers.com/quotescopy.js"></SCRIPT>' ;
				break;
			Case 15:	
				$q = '<SCRIPT TYPE="text/javascript" SRC="http://www.sayitwithhorses.com/horse_quotes.js"></SCRIPT>' ;
				break;
			Case 16:	
				$q = '<SCRIPT TYPE="text/javascript" SRC="http://img.tfd.com/daily/quote-top.js?0"></SCRIPT>' ;
				break;
			Case 17:	
				$q = '<SCRIPT TYPE="text/javascript" SRC="http://www.gurteen.com/gurteen/gurteen.nsf/id/quote-01.js"></SCRIPT>' ;
				break;
			Case 18:	
				$q = '<SCRIPT TYPE="text/javascript" SRC="http://www.motivationalinspirationalquotes.com/Motivational_Quotes.js"></SCRIPT>' ;
				break;
			Case 19:	
				$q = '<SCRIPT TYPE="text/javascript" SRC="http://www.scorequotes.com/qotd.js.php?no_border"></SCRIPT>' ;
				break;
			Case 20:	
				$q = '<SCRIPT TYPE="text/javascript" SRC="http://www.verseoftheday.com/kjvverse.js"></SCRIPT>' ;
				break;	
			default:
				$q = 'Quote not available now';
		}
		MoQuotesDisplay($quote_params, $q);
	}
}

MoQuotesProcessRSS($quote_params);

?>