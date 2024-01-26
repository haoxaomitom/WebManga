

const responsiveBtn = document.querySelector('.header__responsive-btn');
const responsiveMenu = document.querySelector('.header__responsive-menu');

responsiveBtn.addEventListener('click', function() {
  responsiveMenu.classList.toggle('active');
});

document.addEventListener('click', function(event) {
  // Kiểm tra nếu sự kiện click xảy ra không thuộc responsive menu và không thuộc responsive button
  if (!responsiveMenu.contains(event.target) && !responsiveBtn.contains(event.target)) {
    // Xóa lớp active để ẩn menu
    responsiveMenu.classList.remove('active');
  }
});

const wrapper = document.querySelector('.wrapper');
const owlItems = document.querySelectorAll('.owl-item');
const totalItems = owlItems.length;
const containerWidth = 210;
const animationInterval = 2000; // Thời gian chờ giữa các lần di chuyển (2 giây)
const transitionDuration = 800; // Thời gian hoàn thành hiệu ứng di chuyển (0.8 giây)
const pauseDuration = 5000; // Thời gian dừng giữa các lần di chuyển (1.2 giây)
let currentItemIndex = 0;

wrapper.style.transition = `transform ${transitionDuration}ms ease`;

function moveNext() {
  currentItemIndex++;
  const translateXValue = -currentItemIndex * containerWidth;
  wrapper.style.transform = `translateX(${translateXValue}px)`;

  if (currentItemIndex >= totalItems) {
    currentItemIndex = 0;
    wrapper.style.transform = `translateX(0)`;
    setTimeout(() => {
      wrapper.style.transition = `transform ${transitionDuration}ms ease`;
      moveNext();
    }, pauseDuration);
  } else {
    setTimeout(moveNext, pauseDuration);
  }
}

setTimeout(moveNext, animationInterval);

function scrollLeft1() {
  const scrollAmount = containerWidth; // Khoảng cuộn bằng chiều rộng của mỗi slide
  const wrapper = document.querySelector('.item-wrapper');
  const start = wrapper.scrollLeft;
  const change = -scrollAmount;
  const duration = 300; // Thời gian hoàn thành hiệu ứng (0.3 giây)
  let currentTime = 0;

  const animateScroll = function() {
    currentTime += 10;
    const val = Math.easeInOutQuad(currentTime, start, change, duration);
    wrapper.scrollLeft = val;
    if (currentTime < duration) {
      requestAnimationFrame(animateScroll);
    }
  };

  Math.easeInOutQuad = function(t, b, c, d) {
    t /= d / 2;
    if (t < 1) return c / 2 * t * t + b;
    t--;
    return -c / 2 * (t * (t - 2) - 1) + b;
  };

  animateScroll();
}


function scrollRight1() {
  const scrollAmount = containerWidth; // Khoảng cuộn bằng chiều rộng của mỗi slide
  const wrapper = document.querySelector('.item-wrapper');
  const start = wrapper.scrollLeft;
  const change = scrollAmount;
  const duration = 300; // Thời gian hoàn thành hiệu ứng (0.3 giây)
  let currentTime = 0;

  const animateScroll = function() {
    currentTime += 10;
    const val = Math.easeInOutQuad(currentTime, start, change, duration);
    wrapper.scrollLeft = val;
    if (currentTime < duration) {
      requestAnimationFrame(animateScroll);
    }
  };

  Math.easeInOutQuad = function(t, b, c, d) {
    t /= d / 2;
    if (t < 1) return c / 2 * t * t + b;
    t--;
    return -c / 2 * (t * (t - 2) - 1) + b;
  };

  animateScroll();
}

window.addEventListener('DOMContentLoaded', function() {
  // Kích hoạt tab "Top Tháng"
  const defaultTab = 'month';
  const defaultTabLink = document.querySelector('.tab-nav a[onclick*="' + defaultTab + '"]');
  if (defaultTabLink) {
    defaultTabLink.click();
  }
});

function changeTab(tab) {
  // Hủy active trên tất cả các tab
  const tabs = document.querySelectorAll('.tab-nav a');
  tabs.forEach((tab) => {
    tab.classList.remove('active');
  });

  // Ẩn tất cả các phần tử chứa nội dung
  const tabContents = document.querySelectorAll('.tab-pane > div');
  tabContents.forEach((content) => {
    content.style.display = 'none';
  });

  // Kích hoạt tab được chọn
  this.classList.add('active');

  // Hiển thị nội dung tương ứng với tab được chọn
  const selectedContent = document.querySelector(`.top-${tab}`);
  selectedContent.style.display = 'block';
}

// Kích hoạt tab "Top Tuần"
const weekTabLink = document.querySelector('.tab-nav a[onclick*="week"]');
weekTabLink.addEventListener('click', function(event) {
  event.preventDefault();
  changeTab.call(this, 'week');
});

// Kích hoạt tab "Top Ngày"
const dayTabLink = document.querySelector('.tab-nav a[onclick*="day"]');
dayTabLink.addEventListener('click', function(event) {
  event.preventDefault();
  changeTab.call(this, 'day');
});


//-------------------------------------------------------


    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            var username = this.responseText;
            if (username !== '') {
                document.getElementById('username-placeholder').innerText = username;
            }
        }
    };
    xhttp.open("GET", "get-username.php", true); // Tạo một tệp get-username.php để trả về username từ session
    xhttp.send();
var username = "<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>";
if (username !== '') {
    document.getElementById('username-placeholder').innerText = username;
}


















