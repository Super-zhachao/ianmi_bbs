<footer class="copyright"></footer>
<footer class="footer-bar bar-fixed">
    <a href="/" class="footer-bar_item<?=($index == 0 ? ' active' : '')?>">
        <i class="foot-nav i1"></i>
        <span>推荐</span>
    </a>
    <a href="/forum/column" class="footer-bar_item<?=($index == 1 ? ' active': '')?>">
        <i class="foot-nav i2"></i>
        <span>版块</span>
    </a>
    <a href="/forum/add_page" class=" footer-bar_item<?=($index == 2 ? ' active': '')?>">
        <i class="foot-nav i3"></i>
    </a>
    <a href="/active" class="footer-bar_item<?=($index == 3 ? ' active': '')?>">
        <i class="foot-nav i4"></i>
        <span>动态</span>
    </a>
    <a href="<?=href('/user/index')?>" class="footer-bar_item<?=($index == 4 ? ' active': '')?>">
        <i class="foot-nav i5"></i>
        <span>我</span>
    </a>
</footer>