package main

import "fmt"

func main() {

	fmt.Println("PERHITUNGAN INTERPOLASI")
	fmt.Println("Masukkan presentase nilai distribusi: ")

	var pres float64
	_, err := fmt.Scanf("%f", &pres)
	if err != nil {
		fmt.Println("Error: Masukkan harus berupa angka.")
		return
	}

	hasil := interpolasi(float32(pres))
	fmt.Println("Hasil = ", hasil)

}

func interpolasi(pres float32) float32 {

	var present float32 = 20
	var f_present float32 = 3.255

	var present1 float32 = 15
	var f_present1 float32 = 2.113

	hasil := f_present + ((f_present1-f_present)/(present1-present))*(pres-present)
	return hasil
}
