/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main_memset.c                                      :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/07 13:59:16 by malallai          #+#    #+#             */
/*   Updated: 2018/11/07 14:05:19 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"

int		main(int argc, char **argv)
{
	char *temp;

	if (argc == 1)
		str = "abcd efgh ijklm#^()";
	else
		str = argv[1];

	char *str = new char[temp.length()+1];
	strcpy (str, temp.c_str());
	ft_memset(str, '@', 3);
	printf("%s\n", str);
	return (0);
}
