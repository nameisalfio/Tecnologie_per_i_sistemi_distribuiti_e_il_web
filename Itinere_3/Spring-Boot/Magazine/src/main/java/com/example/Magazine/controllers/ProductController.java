package com.example.Magazine.controllers;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;

import com.example.Magazine.models.Product;
import com.example.Magazine.repositories.ProductRepository;

@Controller
public class ProductController {
    private final ProductRepository repo;

    public ProductController(ProductRepository repo) {
        this.repo = repo;
    }

    @GetMapping("/")
    public String index(Model model) {
        model.addAttribute("products", repo.findAll());
        return "index";
    }

    @GetMapping("/create")
    public String create() {
        return "create";
    }

    @PostMapping("/store")
    public String store(Product product) {
        repo.save(product);
        return "redirect:/";
    }

    @GetMapping("/show")
    public String show(Long id, Model model) {
        model.addAttribute("product", repo.findById(id).orElse(null));
        return "show";
    }

    @GetMapping("/edit")
    public String edit(Long id, Model model) {
        model.addAttribute("product", repo.findById(id).orElse(null));
        return "edit";
    }

    @PostMapping("/update")
    public String update(Product product) {
        repo.save(product);
        return "redirect:/";
    }

    @PostMapping("/delete")
    public String delete(Long id) {
        repo.deleteById(id);
        return "redirect:/";
    }

    @GetMapping("/filter")
    public String filter(Model model, String action) {
        if (action.equals("filter")){
            model.addAttribute("products", repo.findByGiacenzaGreaterThan(0));
            return "filter";
        } else {
            return "redirect:/";
        }
    }

    @GetMapping("/decreaseStock")
    public String decreaseStock(Long id, Model model) {
        repo.decreaseStock(id);
        return show(id, model);
    }

    @PostMapping("/decreaseAllPrices")
    public String decreaseAllPrices(Integer percentage) {
        repo.decreaseAllPrices(percentage);
        return "redirect:/";
    }
}
