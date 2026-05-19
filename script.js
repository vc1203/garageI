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

// スライドショー
const slides = document.querySelectorAll('.slide');
const dots   = document.querySelectorAll('.dot');
let current  = 0;
let timer;

function goTo(index) {
  slides[current].classList.remove('active');
  dots[current].classList.remove('active');
  current = index;
  slides[current].classList.add('active');
  dots[current].classList.add('active');
}

function next() {
  goTo((current + 1) % slides.length);
}

function startTimer() {
  timer = setInterval(next, 4000); // 4秒ごとに切り替え
}

// ドットクリックで手動切り替え（タイマーもリセット）
dots.forEach((dot, i) => {
  dot.addEventListener('click', () => {
    clearInterval(timer);
    goTo(i);
    startTimer();
  });
});

startTimer();