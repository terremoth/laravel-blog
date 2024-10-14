<?php

namespace App\Models;

class SocialMedia
{
    protected static array $urls = [
        'blogger' => ['url' => 'www.blogger.com/blog-this.g?u={url}&n={title}&t={text}', 'fa_icon' => '', 'char_limit' => 255],
        'bluesky' => ['url' => 'bsky.app/intent/compose?text={text}', 'fa_icon' => '', 'char_limit' => 300],
        'diaspora' => ['url' => 'share.diasporafoundation.org/?title={title}&url={url}', 'fa_icon' => '', 'char_limit' => 255],
        'douban' => ['url' => 'www.douban.com/recommend/?name={title}&text={text}&comment={url}&href={url}', 'fa_icon' => '', 'char_limit' => 255],
        'evernote' => ['url' => 'www.evernote.com/clip.action?url={url}&title={title}', 'fa_icon' => '', 'char_limit' => 255],
        'facebook' => ['url' => 'www.facebook.com/sharer.php?u={url}', 'fa_icon' => '', 'char_limit' => 255],
        'flipboard' => ['url' => 'share.flipboard.com/bookmarklet/popout?v=2&title={title}&url={url}', 'fa_icon' => '', 'char_limit' => 255],
        'getpocket' => ['url' => 'getpocket.com/edit?url={url}', 'fa_icon' => '', 'char_limit' => 255],
        'googlebookmarks' => ['url' => 'www.google.com/bookmarks/mark?op=edit&bkmk={url}&title={title}&annotation={text}&labels={tags}', 'fa_icon' => '', 'char_limit' => 255],
        'gmail' => ['url' => 'mail.google.com/mail/?view=cm&su={title}&body={url}', 'fa_icon' => '', 'char_limit' => 255],
        'qzone' => ['url' => 'sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url={url}&title={title}&summary={text}', 'fa_icon' => '', 'char_limit' => 255],
        'hackernews' => ['url' => 'news.ycombinator.com/submitlink?u={url}&t={title}', 'fa_icon' => '', 'char_limit' => 255],
        'instapaper' => ['url' => 'www.instapaper.com/edit?url={url}&title={title}&description={text}', 'fa_icon' => '', 'char_limit' => 255],
        'line' => ['url' => 'lineit.line.me/share/ui?url={url}&text={text}', 'fa_icon' => '', 'char_limit' => 255],
        'linkedin' => ['url' => 'www.linkedin.com/sharing/share-offsite/?url={url}', 'fa_icon' => '', 'char_limit' => 255],
        'livejournal' => ['url' => 'www.livejournal.com/update.bml?subject={title}&event={url}', 'fa_icon' => '', 'char_limit' => 255],
        'mastodon' => ['url' => 'mastodon.social/share?text={title}%20{url}', 'fa_icon' => '', 'char_limit' => 500],
        'mailto' => ['url' => 'mailto:?subject={title}&body={url} {text}', 'fa_icon' => '', 'char_limit' => 255],
        'ok.ru' => ['url' => 'connect.ok.ru/dk?st.cmd=WidgetSharePreview&st.shareUrl={url}', 'fa_icon' => '', 'char_limit' => 255],
        'pinterest' => ['url' => 'pinterest.com/pin/create/button/?url={url}', 'fa_icon' => '', 'char_limit' => 255],
        'reddit' => ['url' => 'reddit.com/submit?url={url}&title={title}', 'fa_icon' => '', 'char_limit' => 255],
        'renren' => ['url' => 'widget.renren.com/dialog/share?resourceUrl={url}&srcUrl={url}&title={title}&description={text}', 'fa_icon' => '', 'char_limit' => 255],
        'skype' => ['url' => 'web.skype.com/share?url={url}&text={text}', 'fa_icon' => '', 'char_limit' => 255],
        'tumblr' => ['url' => 'www.tumblr.com/widgets/share/tool?canonicalUrl={url}&title={title}&caption={text}&tags={tags}', 'fa_icon' => '', 'char_limit' => 255],
        'twitter' => ['url' => 'twitter.com/intent/tweet?url={url}&text={title}&hashtags={tags}', 'fa_icon' => '', 'char_limit' => 280],
        'telegram' => ['url' => 't.me/share/url?url={url}&text={text}', 'fa_icon' => '', 'char_limit' => 255],
        'vk' => ['url' => 'vk.com/share.php?url={url}&title={title}&comment={text}', 'fa_icon' => '', 'char_limit' => 255],
        'weibo' => ['url' => 'service.weibo.com/share/share.php?url={url}&appkey=&title={title}&pic=&ralateUid=', 'fa_icon' => '', 'char_limit' => 255],
        'xing' => ['url' => 'www.xing.com/spi/shares/new?url={url}', 'fa_icon' => '', 'char_limit' => 255],
        'yahoomail' => ['url' => 'compose.mail.yahoo.com/?to={email_address}&subject={title}&body={url}', 'fa_icon' => '', 'char_limit' => 255],
    ];

    public function __construct(
        private string $url,
        private string $title,
        private string $text = '',
        private array|string $tags = '') {
    }

    public function getLink(string $socialMedia) : string | bool
    {
        if (!isset(self::$urls[$socialMedia])) {
            return false;
        }

        $brand = self::$urls[$socialMedia];
        $brandUrl = 'https://'.$brand['url'];
        $charLimit = $brand['char_limit'];
        $icon = $brand['fa_icon'];

        $url = urlencode($this->url);
        $title = urlencode(substr($this->title, 0, 255));
        $text = urlencode(substr($this->text, 0, $charLimit-1));
        $tags = urlencode(is_array($this->tags) ? implode(',', $this->tags) : $this->tags);

        $finalUrl = $brandUrl;
        $finalUrl = str_replace('{url}', $url, $finalUrl);
        $finalUrl = str_replace('{title}', $title, $finalUrl);
        $finalUrl = str_replace('{text}', $text, $finalUrl);
        return str_replace('{tags}', $tags, $finalUrl);
    }

    public function getIcon(string $socialMedia) : string
    {
        if (!isset(self::$urls[$socialMedia])) {
            return false;
        }

        return self::$urls[$socialMedia]['fa_icon'];
    }

    public static function available(): array
    {
        $list = array_keys(self::$urls);
        sort($list);
        return $list;
    }
}
