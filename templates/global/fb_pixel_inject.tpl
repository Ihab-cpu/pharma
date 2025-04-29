{*  Universal FB Pixel + Keitaro bridge  *}
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
 n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
 n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);
 t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}
 (window,document,'script','https://connect.facebook.net/en_US/fbevents.js');

const kp = localStorage.getItem('k_subid') ||
           new URLSearchParams(window.location.search).get('subid');
if(kp) localStorage.setItem('k_subid', kp);

function fire(ev,extra={}) {
  const eid = ev+'_'+Date.now();
  fbq('track',ev,extra,{eventID:eid});
  fetch('/fb-capi.php',{method:'POST',headers:{'Content-Type':'application/json'},
    body:JSON.stringify(Object.assign({evName:ev,eid:eid,kp:kp,url:location.href},extra))});
}

fbq('init','1279673910025759',{external_id:kp});
fire('PageView');

/* ---- AddToCart: any link having class "add_to_cart" ---- */
document.addEventListener('click',e=>{
  const a=e.target.closest('a.add_to_cart');
  if(!a) return;
  const val=a.dataset.price||null;
  fire('AddToCart',{value:val,currency:'USD'});
});
</script>
