<?php
/**
 * Template: single.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;
?>
<?php
the_post();
$article = acpl_article( get_post() );
$related = array_map(
    'acpl_article',
    get_posts( array( 'post__not_in' => array( $article['id'] ), 'posts_per_page' => 2 ) )
);
?>
<?php acpl_start( 'layouts.app', ['title' => $article['title'], 'description' => $article['excerpt']] ); ?>
    <section class="relative isolate overflow-hidden bg-white pt-36 pb-20 sm:pt-44 sm:pb-24">
        <div class="brand-lines absolute inset-0 -z-10"></div>
        <div class="absolute -top-32 -right-32 -z-10 size-[36rem] rounded-full bg-gold-200/40 blur-[120px]"></div>
        <canvas data-ribbons="10" data-tone="light" class="absolute inset-0 -z-10 h-full w-full"></canvas>

        <div class="container-x mx-auto max-w-3xl">
            <a href="<?php echo esc_url( acpl_url('insights') ); ?>" class="inline-flex items-center gap-2 text-sm text-mist transition hover:text-gold-700" data-reveal>
                <?php acpl_c( 'icon', ['name' => 'arrow-right', 'class' => 'size-4 rotate-180', 'stroke' => '2'] ); ?> All insights
            </a>
            <p class="mt-10 text-xs font-semibold tracking-[0.22em] text-gold-600 uppercase" data-reveal><?php echo esc_html( $article['category'] ); ?></p>
            <h1 class="mt-5 font-display text-4xl leading-[1.08] text-balance text-navy-900 sm:text-6xl" data-reveal style="--reveal-delay: 80ms"><?php echo esc_html( $article['title'] ); ?></h1>
            <p class="mt-8 flex flex-wrap items-center gap-4 text-sm text-mist" data-reveal style="--reveal-delay: 160ms">
                <time datetime="<?php echo esc_attr( $article['date'] ); ?>"><?php echo esc_html( acpl_date( $article['date'] ) ); ?></time>
                <span class="h-px w-6 bg-navy-900/20"></span>
                <?php echo esc_html( $article['author'] ); ?>
            </p>
        </div>
        <?php acpl_c( 'brand-wave', ['class' => 'absolute inset-x-0 bottom-0 h-10 opacity-90 sm:h-14'] ); ?>
    </section>

    <article class="bg-white py-20 sm:py-24">
        <div class="container-x mx-auto max-w-3xl">
            <p class="font-serif text-2xl leading-relaxed text-navy-800 italic sm:text-3xl"><?php echo esc_html( $article['excerpt'] ); ?></p>
            <?php if ( $article['image'] ) : ?>
                <img src="<?php echo esc_url( $article['image'] ); ?>" alt="" class="mt-12 w-full rounded-3xl object-cover">
            <?php endif; ?>
            <div class="mt-12 space-y-6 text-lg leading-relaxed text-ink/80 [&_a]:text-gold-700 [&_a]:underline [&_blockquote]:border-l-2 [&_blockquote]:border-gold-500 [&_blockquote]:pl-6 [&_blockquote]:font-serif [&_blockquote]:text-2xl [&_blockquote]:italic [&_h2]:pt-6 [&_h2]:font-display [&_h2]:text-3xl [&_h2]:text-navy-900 [&_h3]:pt-4 [&_h3]:font-display [&_h3]:text-2xl [&_h3]:text-navy-900 [&_img]:rounded-2xl [&_li]:ml-6 [&_ol]:list-decimal [&_ul]:list-disc">
                <?php the_content(); ?>
            </div>

            <div class="mt-16 flex flex-col gap-6 rounded-3xl bg-ivory p-8 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="font-display text-2xl text-navy-900">Let’s talk about your next move.</p>
                    <p class="mt-1 text-mist">Speak confidentially with our team.</p>
                </div>
                <a href="<?php echo esc_url( acpl_url('contact') ); ?>#enquire" class="btn-gold shrink-0">Start a conversation <?php acpl_c( 'icon', ['name' => 'arrow-right', 'class' => 'size-4', 'stroke' => '2'] ); ?></a>
            </div>
        </div>
    </article>

    <?php if ( $related ) : ?>
        <section class="bg-sand py-20 sm:py-24">
            <div class="container-x">
                <?php acpl_c( 'section-heading', ['eyebrow' => 'Keep reading', 'title' => 'More insights.'] ); ?>
                <div class="mt-12 grid grid-cols-1 gap-6 md:grid-cols-2">
                    <?php foreach ( acpl_loop( $related ) as [ $loop1, , $other ] ) : ?>
                        <a href="<?php echo esc_url( acpl_url('insights.show', $other['slug']) ); ?>" class="card-light group p-8 transition duration-500 hover:-translate-y-1" data-reveal>
                            <p class="text-xs font-semibold tracking-[0.22em] text-gold-600 uppercase"><?php echo esc_html( $other['category'] ); ?></p>
                            <p class="mt-3 font-display text-2xl text-navy-900 transition group-hover:text-gold-600"><?php echo esc_html( $other['title'] ); ?></p>
                            <p class="mt-3 text-mist"><?php echo esc_html( $other['excerpt'] ); ?></p>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php acpl_end( 'layouts.app' ); ?>
