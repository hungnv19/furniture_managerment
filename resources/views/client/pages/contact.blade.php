@extends('client.layouts.client')
@section('content')
    <!-- Map Begin -->
    <div class="mapDiv">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3723.5655194747114!2d105.73113591436876!3d21.05006379242777!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31345458f6bca645%3A0x10ac77033f26e5b1!2zMTUgTmcuIDgwIMSQLiBYdcOibiBQaMawxqFuZywgWHXDom4gUGjGsMahbmcsIFThu6sgTGnDqm0sIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1658892884537!5m2!1svi!2s"
            width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>

    <!-- Map End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Information</span>
                            <h2>LIÊN HỆ VỚI CHÚNG TÔI</h2>
                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Recusandae exercitationem non nisi
                                sit ab dolores numquam totam magni! Ducimus nemo in enim aperiam labore illum eveniet fugiat
                                doloribus blanditiis harum.</p>
                        </div>
                        <ul>
                            <li>
                                <h4>Cơ sở 1</h4>
                                <p>15 - ngõ 80 Xuân Phương - Nam Từ Liêm - Hà Nội <br />+84 0962523872</p>
                            </li>
                            <li>
                                <h4>Cơ sở 2</h4>
                                <p>Xóm Đông - Nam Phú - Nam Phong - Phú Xuyên - Hà Nội<br />+84 0962523872</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Name">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Email">
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Message"></textarea>
                                    <button type="submit" class="site-btn">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

