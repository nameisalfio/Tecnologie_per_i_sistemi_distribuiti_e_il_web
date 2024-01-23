package com.example.owner_dog.controllers;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;

import com.example.owner_dog.models.Owner;
import com.example.owner_dog.repositories.OwnerRepository;

@Controller
public class OwnerController {

    final OwnerRepository repo;

    public OwnerController(OwnerRepository repo) {
        this.repo = repo;
    }

    @GetMapping("/")
    String welcome() {
        return "welcome";
    }

    @GetMapping("/owners")
    String index(Model model) {
        model.addAttribute("owners", repo.findAll());
        return "/owners/index";
    }

    @GetMapping("/owners/create")
    String create() {
        return "/owners/create";
    }

    @PostMapping("/owners/store")
    String store(Owner o) {
        repo.save(o);
        return "redirect:/owners";
    }

    @GetMapping("/owners/show")
    String show(Model model, Long id) {
        model.addAttribute("o", repo.findById(id).orElse(null));
        return "/owners/show";
    }

    @GetMapping("/owners/edit")
    String edit(Model model, Long id) {
        model.addAttribute("o", repo.findById(id).orElse(null));
        return "/owners/edit";
    }

    @PostMapping("/owners/update")
    String update(Owner o) {
        repo.save(o);
        return "redirect:/owners";
    }

    @PostMapping("/owners/destroy")
    String destroy(Long id) {
        repo.deleteById(id);
        return "redirect:/owners";
    }
}
