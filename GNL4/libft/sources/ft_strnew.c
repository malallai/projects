/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_strnew.c                                        :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2018/11/11 17:22:24 by malallai          #+#    #+#             */
/*   Updated: 2018/12/15 17:33:32 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "libft.h"
#include <stdio.h>

char	*ft_strnew(size_t size)
{
	char *str;

	printf("str new : %zu\n", size);
	if (!(str = (char *)malloc(sizeof(char) * (size + 1))))
		return (NULL);
	printf("allocation work\n");
	ft_bzero(str, size + 1);
	printf("bzero work\n");
	return (str);
}
