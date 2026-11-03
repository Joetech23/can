<?php
/**
 * Template: archive-acpl_team.
 *
 * @package Angelus
 */

defined( 'ABSPATH' ) || exit;
?>
<?php acpl_start( 'layouts.app', ['title' => 'Leadership', 'description' => 'Meet the experienced leadership team of Angelus Capital Partners Limited.'] ); ?>
    <?php acpl_c( 'page-hero', ['index' => '04', 'eyebrow' => 'Leadership', 'title' => 'Experienced <span class=\'text-gold-gradient\'>leadership</span> team.', 'lead' => 'Decades of combined experience spanning private equity, venture capital, banking, audit, pensions, investment management and corporate governance.'] ); ?>

    <section class="bg-ivory py-24 sm:py-32">
        <div class="container-x grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
            <?php foreach ( acpl_loop( acpl_leaders() ) as [ $loop1, , $leader ] ) : ?>
                <a href="<?php echo esc_url( acpl_url('leadership.show', $leader['slug']) ); ?>" class="card-light group flex flex-col overflow-hidden p-6 transition duration-500 hover:-translate-y-1.5 sm:p-7" data-reveal style="--reveal-delay: <?php echo esc_html( $loop1->index * 120 ); ?>ms">
                    <?php acpl_c( 'portrait', ['leader' => $leader, 'eager' => $loop1->first, 'class' => 'mx-auto w-full max-w-64'] ); ?>

                    <div class="mt-8 flex flex-1 flex-col">
                        <p class="text-xs font-semibold tracking-[0.22em] text-gold-600 uppercase"><?php echo esc_html( $leader['role'] ); ?></p>
                        <h2 class="mt-2 font-display text-3xl leading-tight text-navy-900"><?php echo esc_html( $leader['name'] ); ?></h2>
                        <p class="mt-4 flex-1 leading-relaxed text-mist"><?php echo esc_html( $leader['bio'] ); ?></p>
                        <ul class="mt-6 flex flex-wrap gap-2">
                            <?php foreach ( acpl_loop( $leader['focus'] ) as [ $loop2, , $focus ] ) : ?>
                                <li class="rounded-full bg-sand px-3.5 py-1.5 text-xs font-semibold text-navy-800"><?php echo esc_html( $focus ); ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <span class="link-arrow mt-8">Full profile <?php acpl_c( 'icon', ['name' => 'arrow-right', 'class' => 'size-4', 'stroke' => '2'] ); ?></span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="bg-white py-24 sm:py-32">
        <div class="container-x">
            <?php acpl_c( 'section-heading', ['eyebrow' => 'Why partner with ACPL', 'title' => 'Experience you can build on.', 'align' => 'center'] ); ?>
            <div class="mt-16 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                <?php foreach ( acpl_loop( acpl('differentiators') ) as [ $loop1, , $item ] ) : ?>
                    <div class="group flex gap-5 rounded-3xl border border-navy-900/8 p-8 transition duration-500 hover:border-gold-500/40 hover:bg-ivory" data-reveal style="--reveal-delay: <?php echo esc_html( ($loop1->index % 3) * 90 ); ?>ms">
                        <span class="hex grid size-14 shrink-0 place-items-center bg-navy-900 font-display text-gold-300 transition group-hover:bg-gradient-to-br group-hover:from-gold-300 group-hover:to-ember group-hover:text-navy-950">0<?php echo esc_html( $loop1->iteration ); ?></span>
                        <div>
                            <h3 class="font-display text-xl text-navy-900"><?php echo esc_html( $item['title'] ); ?></h3>
                            <p class="mt-2 text-sm leading-relaxed text-mist"><?php echo esc_html( $item['text'] ); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <?php acpl_c( 'cta-band', ['page' => 'leadership'] ); ?>
<?php acpl_end( 'layouts.app' ); ?>
