// 幅縮小でメニューのアイコンに変更
document.querySelector('.menu-trigger').addEventListener('click', function() {
  this.classList.toggle('active');
  document.querySelector('.nav-content').classList.toggle('is-open');
});

// スクロールでコンテンツが浮き上がるアニメーション
const els = document.querySelectorAll('.fade');

const obs = new IntersectionObserver(entries=>{
  entries.forEach(e=>{
    if(e.isIntersecting){
      e.target.classList.add('show');
    }
  });
});

els.forEach(el=>obs.observe(el));