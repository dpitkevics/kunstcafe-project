$(function () {
    var galleryUl = $("ul.gallery");
    galleryUl.find("li.image:first-child").addClass('gallery-image-active');
    galleryUl.find('li.image:not(:first-child)').css('display', 'none');

    galleryUl.data("currentImage", 1);
    var totalImages = galleryUl.find("li.image").length;

    $("#gallery-next").on("click", function () {
        var currentImage = galleryUl.data("currentImage");
        var nextImage;
        if (currentImage === totalImages) {
            nextImage = 1;
        } else {
            nextImage = currentImage + 1;
        }

        galleryUl.data("currentImage", nextImage);

        switchImage(galleryUl, currentImage, nextImage);
    });

    $("#gallery-previous").on("click", function () {
        var currentImage = galleryUl.data("currentImage");
        var nextImage;
        if (currentImage === 1) {
            nextImage = totalImages;
        } else {
            nextImage = currentImage - 1;
        }

        galleryUl.data("currentImage", nextImage);

        switchImage(galleryUl, currentImage, nextImage);
    });
});

function switchImage(galleryUl, currentImage, nextImage)
{
    galleryUl.find("li.image:nth-child("+currentImage+")").slideToggle(500);
    galleryUl.find("li.image:nth-child("+nextImage+")").slideToggle(500, function () {
        positionAllInMiddleElements();
    });
}